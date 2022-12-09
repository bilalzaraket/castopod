<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'all_podcasts' => 'Alle podkastar',
    'no_podcast' => 'Fann ingen podkast!',
    'create' => 'Lag ein podcast',
    'import' => 'Importer ein podkast',
    'new_episode' => 'Ny episode',
    'view' => 'Sjå podkasten',
    'edit' => 'Rediger podkasten',
    'publish' => 'Publish podcast',
    'publish_edit' => 'Edit publication',
    'delete' => 'Slett podkasten',
    'see_episodes' => 'Sjå episodane',
    'see_contributors' => 'Sjå bidragsytarane',
    'go_to_page' => 'Gå til side',
    'latest_episodes' => 'Dei nyaste episodane',
    'see_all_episodes' => 'Sjå alle episodane',
    'draft' => 'Draft',
    'messages' => [
        'createSuccess' => 'Podcast successfully created!',
        'editSuccess' => 'Podkasten er oppdatert!',
        'importSuccess' => 'Podkasten er importert!',
        'deleteSuccess' => 'Podcast @{podcast_handle} successfully deleted!',
        'deletePodcastMediaError' => 'Failed to delete podcast {type, select,
            cover {cover}
            banner {banner}
            other {media}
        }.',
        'deleteEpisodeMediaError' => 'Failed to delete podcast episode {episode_slug} {type, select,
            transcript {transcript}
            chapters {chapters}
            image {cover}
            audio {audio}
            other {media}
        }.',
        'deletePodcastMediaFolderError' => 'Failed to delete podcast media folder {folder_path}. You may manually remove it from your disk.',
        'podcastFeedUpdateSuccess' => 'Successful update: {number_of_new_episodes, plural,
            one {# episode was}
            other {# episodes were}
        } added to the podcast!',
        'podcastFeedUpToDate' => 'Podcast is already up to date.',
        'podcastNotImported' => 'Podcast could not be updated as it was not imported.',
        'publishError' => 'This podcast is either already published or scheduled for publication.',
        'publishEditError' => 'This podcast is not scheduled for publication.',
        'publishCancelSuccess' => 'Podcast publication successfully cancelled!',
        'scheduleDateError' => 'Schedule date must be set!',
    ],
    'form' => [
        'identity_section_title' => 'Podkastidentitet',
        'identity_section_subtitle' => 'Desse felta gjer at du blir lagt merke til.',
        'cover' => 'Podkastomslag',
        'cover_size_hint' => 'Cover must be squared and at least 1400px wide and tall.',
        'banner' => 'Podkastbanner',
        'banner_size_hint' => 'Banner must have a 3:1 ratio and be at least 1500px wide.',
        'banner_delete' => 'Slett podkastbanneret',
        'title' => 'Tittel',
        'handle' => 'Handtak',
        'handle_hint' =>
            'Blir brukt til å identifisera podkasten. Du kan bruka store og små bokstavar, tal og understrek.',
        'type' => [
            'label' => 'Type',
            'episodic' => 'Med episodar',
            'episodic_hint' => 'Viss det er meininga at episodane skal kunna lyttast til uansett rekkjefylgje. Dei nyaste episodane blir presenterte fyrst.',
            'serial' => 'I serie',
            'serial_hint' => 'Viss det er meininga at episodane skal koma i ei bestemt rekkjefylgje. Dei eldste episodane blir presenterte fyrst.',
        ],
        'description' => 'Skildring',
        'classification_section_title' => 'Klassifisering',
        'classification_section_subtitle' =>
            'Desse felta vil påverka publikummet og konkurransen din.',
        'language' => 'Språk',
        'category' => 'Kategori',
        'category_placeholder' => 'Vel ein kategori…',
        'other_categories' => 'Andre kategoriar',
        'parental_advisory' => [
            'label' => 'Råd til foreldre',
            'hint' => 'Er det grov prat her?',
            'undefined' => 'udefinert',
            'clean' => 'Familievenleg',
            'explicit' => 'Grovt',
        ],
        'author_section_title' => 'Forfattar',
        'author_section_subtitle' => 'Kven styrer podkasten?',
        'owner_name' => 'Namn på eigaren',
        'owner_name_hint' =>
            'Berre til administrativ bruk. Synleg i den offentlege RSS-straumen.',
        'owner_email' => 'Epost til eigaren',
        'owner_email_hint' =>
            'Blir brukt av dei fleste plattformer til å stadfesta eigarskapen til podkasten. Synleg i den offentlege RSS-straumen.',
        'publisher' => 'Utgjevar',
        'publisher_hint' =>
            'Gruppa som er ansvarleg for serien. Det er vanlegvis morselskapet eller nettverket til ein podkast. Dette feltet er stundom merka med «forfattar».',
        'copyright' => 'Opphavsrett',
        'location_section_title' => 'Stad',
        'location_section_subtitle' => 'Kva stad handlar denne podkasten om?',
        'location_name' => 'Stadnamn eller adresse',
        'location_name_hint' => 'Dette kan vera ein verkeleg eller oppdikta stad',
        'monetization_section_title' => 'Kommersialisering',
        'monetization_section_subtitle' =>
            'Ten pengar med hjelp frå publikummet ditt.',
        'premium' => 'Premium',
        'premium_by_default' => 'Episodes must be set as premium by default',
        'premium_by_default_hint' => 'Podcast episodes will be marked as premium by default. You can still choose to set some episodes, trailers or bonuses as public.',
        'op3' => 'Open Podcast Prefix Project (OP3)',
        'op3_hint' => 'Value your analytics data with OP3, an open-source and trusted third party analytics service. Share, validate and compare your analytics data with the open podcasting ecosystem.',
        'op3_enable' => 'Enable OP3 analytics service',
        'op3_enable_hint' => 'For security reasons, premium episodes\' analytics data will not be shared with OP3.',
        'payment_pointer' => 'Betalingspunkt for nettkommersialisering',
        'payment_pointer_hint' =>
            'Det er her du vil få inn pengar frå nettkommersialiseringa',
        'advanced_section_title' => 'Avanserte innstillingar',
        'advanced_section_subtitle' =>
            'Viss du treng RSS-merkelappar som Castopod ikkje handterer, kan du skriva dei inn her.',
        'custom_rss' => 'Eigne RSS-merkelappar for podkasten',
        'custom_rss_hint' => 'Dette blir sett inn i ❬channel❭-elementet.',
        'new_feed_url' => 'Ny straum-URL',
        'new_feed_url_hint' => 'Bruk dette feltet når du flyttar til eit anna domene eller vertsplattform. Standardvalet for verdien er den noverande RSS-adresse viss podkasten er importert.',
        'old_feed_url' => 'Old feed URL',
        'update_feed' => 'Update feed',
        'update_feed_tip' => 'Import this podcast\'s latest episodes',
        'partnership' => 'Partnarskap',
        'partner_id' => 'ID',
        'partner_link_url' => 'Lenke-URL',
        'partner_image_url' => 'Bilet-URL',
        'partner_id_hint' => 'Din eigen partnar-ID',
        'partner_link_url_hint' => 'Lenkeadressa til den generelle partnaren',
        'partner_image_url_hint' => 'Biletadressa til den generelle partnaren',
        'status_section_title' => 'Status',
        'block' => 'Podcast should be hidden from public catalogues',
        'block_hint' =>
            'The podcast show or hide status: toggling this on prevents the entire podcast from appearing in Apple Podcasts, Google Podcasts, and any third party apps that pull shows from these directories. (Not guaranteed)',
        'complete' => 'Podkasten vil ikkje få fleire episodar',
        'lock' => 'Hindre at podkasten blir kopiert',
        'lock_hint' =>
            'Føremålet er å fortelja andre podkastplattformer om dei kan importera denne straumen. Dersom verdien er ja, blir alle forsøk på å importera denne straumen til ei ny plattform nekta.',
        'submit_create' => 'Lag podkast',
        'submit_edit' => 'Lagre podkasten',
    ],
    'category_options' => [
        'uncategorized' => 'ukategorisert',
        'arts' => 'Kunst',
        'business' => 'Forretningar',
        'comedy' => 'Komedie',
        'education' => 'Utdanning',
        'fiction' => 'Fiksjon',
        'government' => 'Styresmakter',
        'health_and_fitness' => 'Helse og trening',
        'history' => 'Historie',
        'kids_and_family' => 'Born &amp familie',
        'leisure' => 'Fritid',
        'music' => 'Musikk',
        'news' => 'Nytt',
        'religion_and_spirituality' => 'Religion &amp spiritualitet',
        'science' => 'Vitskap',
        'society_and_culture' => 'Samfunn &amp kultur',
        'sports' => 'Idrett',
        'technology' => 'Teknologi',
        'true_crime' => 'Sann krim',
        'tv_and_film' => 'TV &amp film',
        'books' => 'Bøker',
        'design' => 'Design',
        'fashion_and_beauty' => 'Mote &amp venleik',
        'food' => 'Mat',
        'performing_arts' => 'Utøvande kunst',
        'visual_arts' => 'Visuell kunst',
        'careers' => 'Karriere',
        'entrepreneurship' => 'Entreprenørskap',
        'investing' => 'Investering',
        'management' => 'Leiing',
        'marketing' => 'Marknadsføring',
        'non_profit' => 'Friviljug arbeid',
        'comedy_interviews' => 'Humor-intervju',
        'improv' => 'Improvisasjon',
        'stand_up' => 'Ståkomikk',
        'courses' => 'Kurs',
        'how_to' => 'Slik gjer du',
        'language_learning' => 'Språklæring',
        'self_improvement' => 'Sjølvforbetring',
        'comedy_fiction' => 'Oppdikta humor',
        'drama' => 'Drama',
        'science_fiction' => 'Science Fiction',
        'alternative_health' => 'Alternativ helse',
        'fitness' => 'Kom i form',
        'medicine' => 'Medisin',
        'mental_health' => 'Mental helse',
        'nutrition' => 'Næring',
        'sexuality' => 'Seksualitet',
        'education_for_kids' => 'Utdanning for born',
        'parenting' => 'Oppseding',
        'pets_and_animals' => 'Kjæledyr &amp dyr',
        'stories_for_kids' => 'Historier for born',
        'animation_and_manga' => 'Animasjon &amp manga',
        'automotive' => 'Bil og motor',
        'aviation' => 'Luftfart',
        'crafts' => 'Handverk',
        'games' => 'Spel',
        'hobbies' => 'Hobbyar',
        'home_and_garden' => 'Heim og hage',
        'video_games' => 'Videospel',
        'music_commentary' => 'Musikkommentarar',
        'music_history' => 'Musikkhistorie',
        'music_interviews' => 'Musikkintervju',
        'business_news' => 'Handelsnytt',
        'daily_news' => 'Dagleg nytt',
        'entertainment_news' => 'Underhaldningsnytt',
        'news_commentary' => 'Kommentarar til nyhende',
        'politics' => 'Politikk',
        'sports_news' => 'Sportsnytt',
        'tech_news' => 'Teknologinytt',
        'buddhism' => 'Buddhisme',
        'christianity' => 'Kristendom',
        'hinduism' => 'Hinduisme',
        'islam' => 'Islam',
        'judaism' => 'Jødedom',
        'religion' => 'Religion',
        'spirituality' => 'Spiritualitet',
        'astronomy' => 'Astronomi',
        'chemistry' => 'Kjemi',
        'earth_sciences' => 'Geofag',
        'life_sciences' => 'Humaniora',
        'mathematics' => 'Matematikk',
        'natural_sciences' => 'Naturvitskap',
        'nature' => 'Natur',
        'physics' => 'Fysisk',
        'social_sciences' => 'Sosialfag',
        'documentary' => 'Dokumentar',
        'personal_journals' => 'Personlege journalar',
        'philosophy' => 'Filosofi',
        'places_and_travel' => 'Stader &amp reise',
        'relationships' => 'Forhold',
        'baseball' => 'Baseball',
        'basketball' => 'Basketball',
        'cricket' => 'Cricket',
        'fantasy_sports' => 'Fantasiidrettar',
        'football' => 'Fotball',
        'golf' => 'Golf',
        'hockey' => 'Hockey',
        'rugby' => 'Rugby',
        'running' => 'Springing',
        'soccer' => 'Fotball',
        'swimming' => 'Symjing',
        'tennis' => 'Tennis',
        'volleyball' => 'Volleyball',
        'wilderness' => 'Villmark',
        'wrestling' => 'Bryting',
        'after_shows' => 'Etterprogram',
        'film_history' => 'Filmhistorie',
        'film_interviews' => 'Filmintervju',
        'film_reviews' => 'Filmmeldingar',
        'tv_reviews' => 'TV-meldingar',
    ],
    'publish_form' => [
        'back_to_podcast_dashboard' => 'Back to podcast dashboard',
        'post' => 'Your announcement post',
        'post_hint' =>
            "Write a message to announce the publication of your podcast. The message will be featured in your podcast's homepage.",
        'message_placeholder' => 'Write your message…',
        'submit' => 'Publish',
        'publication_date' => 'Publication date',
        'publication_method' => [
            'now' => 'Now',
            'schedule' => 'Schedule',
        ],
        'scheduled_publication_date' => 'Scheduled publication date',
        'scheduled_publication_date_hint' =>
            'You can schedule the podcast release by setting a future publication date. This field must be formatted as YYYY-MM-DD HH:mm',
        'submit_edit' => 'Edit publication',
        'cancel_publication' => 'Cancel publication',
        'message_warning' => 'You did not write a message for your announcement post!',
        'message_warning_hint' => 'Having a message increases social engagement, resulting in a better visibility for your podcast.',
        'message_warning_submit' => 'Publish anyway',
    ],
    'publication_status_banner' => [
        'draft_mode' => 'draft mode',
        'not_published' => 'This podcast is not yet published.',
        'scheduled' => 'This podcast is scheduled for publication on {publication_date}.',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Deleting the podcast will delete all episodes, media files, posts and analytics associated with it. This action is irreversible, you will not be able to retrieve them afterwards.",
        'understand' => 'I understand, I want the podcast to be permanently deleted',
        'submit' => 'Delete',
    ],
    'by' => 'Av {publisher}',
    'season' => 'Sesong {seasonNumber}',
    'list_of_episodes_year' => '{year}-episodar ({episodeCount})',
    'list_of_episodes_season' =>
        'Sesong {seasonNumber}-episodar ({episodeCount})',
    'no_episode' => 'Fann ingen episode!',
    'follow' => 'Fylg',
    'followers' => '{numberOfFollowers, plural,
        one {# follower}
        other {# followers}
    }',
    'posts' => '{numberOfPosts, plural,
        one {# post}
        other {# posts}
    }',
    'activity' => 'Aktivitet',
    'episodes' => 'Episodar',
    'sponsor' => 'Sponsor',
    'funding_links' => 'Finansieringslenker for {podcastTitle}',
    'find_on' => 'Finn {podcastTitle} på',
    'listen_on' => 'Høyr på',
];
