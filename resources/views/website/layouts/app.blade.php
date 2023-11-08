<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">
    <head>
        <base href="/">
        <meta charset="utf-8"/>
        <meta name="robots" content="nofollow"/>
        <title>{{((isset($title))?strip_tags($title).' | ':'').conf('system_title')}}</title>
        <meta name="description" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link rel="icon" href="{{asset("storage/configurations/".conf('system_logo'))}}" />

        @vite('resources/site/css/app.css')
        @vite('resources/site/js/app.js')

        <meta name="csrf-token" content="{{csrf_token()}}"/>
        <!-- append assets of pwa package -->
        <script>
            let deferredPrompt;

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


            function showInstallPromotion(){
                const popup = document.createElement('div');
                const wrapper = document.createElement('div');
                const button = document.createElement('div');
                const para = document.createElement('p');


                popup.id = 'popup';
                popup.classList.add('popup','promoting-install-app-prompt','card');

                wrapper.classList.add('d-flex','justify-content-between','align-items-center','card-body');
                para.innerText="اضافه کردن برنامه به صفحه اصلی گوشی";
                para.classList.add('m-0','install-message');

                button.innerText ="نصب برنامه";
                button.classList.add('btn','btn-primary');
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

            function hideInstallPromotion(){
                const prompt = document.querySelector('.promoting-install-app-prompt');
                prompt.remove();
            }
        </script>
        @laravelPWA
        <style>
            div#popup {
                position: fixed !important;
                top: calc(100vh - 100px) !important;
                min-width: 500px ;
            }
        </style>
    </head>
    <body id="app">
        @include("website.layouts.header")
        <section class="farm-area" style="padding-top: 100px">
            <div class="container">
                @yield("content")
            </div>
        </section>
        @include("website.layouts.footer")
    </body>

</html>
