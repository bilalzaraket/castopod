<?= helper('page') ?>
<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <title><?= service('settings')
    ->get('App.siteName') ?></title>
    <meta name="description" content="<?= service('settings')
    ->get('App.siteDescription') ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/x-icon" href="<?= service('settings')
    ->get('App.siteIcon')['ico'] ?>" />
    <link rel="apple-touch-icon" href="<?= service('settings')->get('App.siteIcon')['180'] ?>">
    <link rel="manifest" href="<?= route_to('webmanifest') ?>">

    <meta property="og:title" content="<?= service('settings')
    ->get('App.siteName') ?>" />
    <meta property="og:description" content="<?= service('settings')
    ->get('App.siteDescription') ?>" />
    <meta property="og:site_name" content="<?= service('settings')
    ->get('App.siteName') ?>" />

    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/app.ts', 'js') ?>
</head>

<body class="flex flex-col min-h-screen mx-auto bg-pine-50">
    <?php if (service('authentication')->check()): ?>
        <?= $this->include('_admin_navbar') ?>
    <?php endif; ?>

    <header class="py-8 text-white border-b bg-pine-800">
        <div class="container flex items-center justify-between px-2 py-4 mx-auto">
            <a href="<?= route_to(
            'home',
        ) ?>" class="inline-flex items-baseline text-3xl font-semibold font-display"><?= 'castopod' .
    svg('castopod-logo-base', 'h-6 ml-2') ?></a>
        </div>
    </header>
    <main class="container flex-1 px-4 py-10 mx-auto">
        <h1 class="mb-2 text-xl"><?= lang('Home.all_podcasts') ?> (<?= count(
        $podcasts,
    ) ?>)</h1>
        <section class="grid gap-4 grid-cols-cards">
            <?php if ($podcasts): ?>
                <?php foreach ($podcasts as $podcast): ?>
                    <a href="<?= $podcast->link ?>" class="relative w-full h-full overflow-hidden transition shadow focus:ring-castopod rounded-xl border-pine-100 hover:shadow-xl focus:shadow-xl group border-3">
                        <article class="text-white">
                            <div class="absolute bottom-0 left-0 z-10 w-full h-full backdrop-gradient"></div>
                            <div class="w-full h-full overflow-hidden">
                                <img alt="<?= $podcast->title ?>" src="<?= $podcast->cover->medium_url ?>" class="object-cover w-full h-full transition duration-200 ease-in-out transform group-focus:scale-105 group-hover:scale-105" />
                            </div>
                            <div class="absolute bottom-0 left-0 z-20 px-4 pb-2">
                                <h2 class="font-bold leading-none truncate font-display"><?= $podcast->title ?></h2>
                                <p class="text-sm opacity-75">@<?= $podcast->handle ?></p>
                            </div>
                        </article>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="italic"><?= lang('Home.no_podcast') ?></p>
            <?php endif; ?>
        </section>
    </main>
    <footer class="container flex justify-between px-2 py-4 mx-auto text-sm text-right border-t">
        <?= render_page_links() ?>
        <small><?= lang('Common.powered_by', [
            'castopod' =>
                '<a class="inline-flex font-semibold hover:underline focus:ring-castopod" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod' . icon('social/castopod', 'ml-1 text-lg') . '</a>',
        ]) ?></small>
    </footer>
</body>