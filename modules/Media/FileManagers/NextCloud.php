<?php

declare(strict_types=1);

namespace Modules\Media\FileManagers;

use OC\Files\Filesystem;
use OC\User\Session;
use OCP\IUserManager;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Response;
use Exception;
use Modules\Media\Config\Media as MediaConfig;

class NextcloudFileManager implements FileManagerInterface
{
    private $userSession;
    private $fileManager;
    private $client;

    public function __construct(IUserManager $userManager, string $username, string $password)
    {
        $user = $userManager->get($username);
        $this->userSession = new Session();
        $this->userSession->setUser($user);
        $this->fileManager = Filesystem::getStorage();

        $this->client = \OC::$server->getClientService()->newClient();
        $this->client->login($username, $password);
    }
    public function save(File $file, string $key): string|false
    {
        try {
            $path = $this->userSession->getUser()->getHome() . '/' . $key; //gets the home path of nextcloud and then adds the "key" directory
            $this->fileManager->file_put_contents($path, $file->getContents()); //uses the filemanager storage object to save the content

            unlink($file->getPathname()); // uses the built-in unlink function to delete the file from the system

            return $key; //returns the key
        } catch (Exception $e) {
            return false;
        }
    }

    //deletes the file defined by the path: "key" and returns a boolean
    public function delete(string $key): bool
    {
        try {
            $path = $this->userSession->getUser()->getHome() . '/' . $key;
            $this->fileManager->unlink($path);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    //gets the nextcloud url of the directory or url defined by key:
    public function getUrl(string $key): string
    {
        return $this->userSession->getUser()->getHome() . '/' . $key; //there is a function defined for the filemanager for nextcloud to get the downlowd link to download the files: getDownloadUrl($path)

    }

    //function to rename a file:

    public function rename(string $oldKey, string $newKey): bool
    {
        try {
            $oldPath = $this->userSession->getUser()->getHome() . '/' . $oldKey; //old file
            $newPath = $this->userSession->getUser()->getHome() . '/' . $newKey;

            $this->fileManager->copy($oldPath, $newPath);
        } catch (Exception) {
            return false;
        }

        return $this->delete($oldKey);
    }


    //In this function there is a problem in the format that the function returns, the interface defined it to return a string (so the file as a string)
    public function getFileContents(string $key): string|false
    {
        try {
            $path = $this->userSession->getUser()->getHome() . '/' . $key;
            $contents = file_get_contents($path);
        } catch (Exception) {
            return false;
        }

        return (string) $contents; //COULD CAUSE PROBLEMS
    }

    public function getFileInput(string $key): string
    {
        return $this->getUrl($key);
    }


    public function deletePodcastImageSizes(string $podcastHandle): bool
    {
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            $this->deleteAll('podcasts/' . $podcastHandle, "*_*{$ext}");
        }

        return true;
    }

    public function deletePersonImagesSizes(): bool
    {
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            $this->deleteAll('persons', "*_*{$ext}");
        }

        return true;
    }

    public function deleteAll(string $prefix, ?string $pattern = '*'): bool
    {
        $prefix = rtrim($prefix, '/') . '/'; // Remove trailing slashes from prefix
        $fullPath = $prefix . $pattern; // Construct full path for pattern matching

        // Get a list of all files and directories that match the pattern
        //I found this to be the best solution in the case there's a large corpse of files: it will function in a similar way to the paginator defined in aws s3
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $prefix,
                FilesystemIterator::SKIP_DOTS
            ),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        //files that we need to delete
        $filesToDelete = [];
        //loop to find all the matches of the format
        foreach ($iterator as $path => $file) {
            if (fnmatch($fullPath, $path)) {
                $filesToDelete[] = $path;
            }
        }

        // Delete all files and directories that match the pattern
        $success = true;
        foreach ($filesToDelete as $path) {
            try {
                \OC\Files\Filesystem::unlink($path);
            } catch (Exception $e) {
                $success = false;
            }
        }
        return $success;
    }

    public function isHealthy(): bool
    {
    }



}