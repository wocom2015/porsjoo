<!-- Web Application Manifest -->
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">
<!-- Chrome for Android theme color -->
<meta name="theme-color" content="{{ $config['theme_color'] }}">

<!-- Add to homescreen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="{{ $config['display'] == 'standalone' ? 'yes' : 'no' }}">
<meta name="application-name" content="{{ $config['short_name'] }}">
<link rel="icon" sizes="{{ data_get(end($config['icons']), 'sizes') }}" href="{{ data_get(end($config['icons']), 'src') }}">

<!-- Add to homescreen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="{{ $config['display'] == 'standalone' ? 'yes' : 'no' }}">
<meta name="apple-mobile-web-app-status-bar-style" content="{{  $config['status_bar'] }}">
<meta name="apple-mobile-web-app-title" content="{{ $config['short_name'] }}">
<link rel="apple-touch-icon" href="{{ data_get(end($config['icons']), 'src') }}">


<link href="{{ $config['splash']['640x1136'] }}" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['750x1334'] }}" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1242x2208'] }}" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1125x2436'] }}" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['828x1792'] }}" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1242x2688'] }}" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1536x2048'] }}" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1668x2224'] }}" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1668x2388'] }}" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['2048x2732'] }}" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

<!-- Tile for Win8 -->
<meta name="msapplication-TileColor" content="{{ $config['background_color'] }}">
<meta name="msapplication-TileImage" content="{{ data_get(end($config['icons']), 'src') }}">

<script type="text/javascript">
    let deferredPrompt;

    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
            scope: '.'
        }).then(function (registration) {
            // Registration was successful
            // console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);


            window.addEventListener('beforeinstallprompt', (e) => {
                // Prevent the mini-infobar from appearing on mobile
                e.preventDefault();
                // Stash the event so it can be triggered later.
                deferredPrompt = e;
                // Update UI notify the user they can install the PWA
                showInstallPromotion();
            });
            window.addEventListener('appinstalled', () => {
                // Hide the app-provided install promotion
                hideInstallPromotion();
                // Clear the deferredPrompt so it can be garbage collected
                deferredPrompt = null;
                // Optionally, send analytics event to indicate successful install
                // console.log('PWA was installed');
            });
        }, function (err) {
            // registration failed :(
            // console.log('Laravel PWA: ServiceWorker registration failed: ', err);
        });
    }

    function showInstallPromotion() {
        const popup = document.createElement('div');
        const wrapper = document.createElement('div');
        const button = document.createElement('div');
        const para = document.createElement('p');


        // popup.classList.add('promoting-install-app-prompt','card');
        popup.classList.add('promoting-install-app-prompt', 'm-1', 'card');

        wrapper.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'card-body');
        para.innerText = "اضافه کردن برنامه به صفحه اصلی گوشی";
        para.classList.add('m-0', 'install-message');

        button.innerText = "نصب برنامه";
        button.classList.add('btn', 'btn-primary');
        button.addEventListener('click', async () => {
            // Hide the app provided install promotion
            // hideInstallPromotion();
            // Show the install prompt
            deferredPrompt.prompt();
            // Wait for the user to respond to the prompt
            const { outcome } = await deferredPrompt.userChoice;
            // Optionally, send analytics event with outcome of user choice
            console.log(`User response to the install prompt: ${outcome}`);
            // We've used the prompt, and can't use it again, throw it away
            deferredPrompt = null;
        });


        wrapper.appendChild(para);
        wrapper.appendChild(button);

        popup.appendChild(wrapper);

        document.body.appendChild(popup);

    }

    function hideInstallPromotion() {
        const prompt = document.querySelector('.promoting-install-app-prompt');
        prompt.remove();
    }
</script>
<style>
    div.promoting-install-app-prompt {
        position: fixed !important;
        top: calc(100vh - 100px) !important;
        /*min-width: 320px;*/
        width: 80%;
        /*margin: 0 20px;*/
        left: 0;
    }
</style>
