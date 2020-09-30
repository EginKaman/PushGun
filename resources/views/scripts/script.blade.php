<script>
    (window.onload = async function () {
        let pattern = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i;
        let isMobile = function (userAgent) {
            return pattern.test(userAgent);
        };
        if (isMobile(navigator.userAgent || navigator.vendor || window.opera) === {{ $site->mobile }}) {
            if (!('serviceWorker' in navigator)) {
                // Браузер не поддерживает сервис-воркеры.
                return;
            }

            if (!('PushManager' in window)) {
                // Браузер не поддерживает push-уведомления.
                return;
            }

            function requestPermission() {
                return new Promise(function (resolve, reject) {
                    const permissionResult = Notification.requestPermission(function (result) {
                        // Поддержка устаревшей версии с функцией обратного вызова.
                        resolve(result);
                    });

                    if (permissionResult) {
                        permissionResult.then(resolve, reject);
                    }
                })
                    .then(function (permissionResult) {
                        if (permissionResult !== 'granted') {
                            throw new Error('Permission not granted.');
                        }
                    });
            }

            function urlBase64ToUint8Array(base64String) {
                var padding = '='.repeat((4 - base64String.length % 4) % 4);
                var base64 = (base64String + padding)
                    .replace(/\-/g, '+')
                    .replace(/_/g, '/');

                var rawData = window.atob(base64);
                var outputArray = new Uint8Array(rawData.length);

                for (var i = 0; i < rawData.length; ++i) {
                    outputArray[i] = rawData.charCodeAt(i);
                }
                return outputArray;
            }

            function updateSubscription(subscription) {
                const key = subscription.getKey('p256dh')
                const token = subscription.getKey('auth')
                const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0]

                const data = {
                    endpoint: subscription.endpoint,
                    publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
                    authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
                    contentEncoding
                }

                fetch('{{ route('subscribe.update', $site) }}', {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then(res => {
                    console.log("Registration is complite:", res);
                }).catch(err => {
                    console.log("some note working")
                });
            }

            function subscribeUserToPush() {
                return navigator.serviceWorker.register('/pg-push-worker.js')
                    .then(function (registration) {
                        var subscribeOptions = {
                            userVisibleOnly: true,
                            applicationServerKey: urlBase64ToUint8Array(
                                '{{ config('webpush.vapid.public_key') }}'
                            )
                        };
                        return registration.pushManager.subscribe(subscribeOptions);
                    })
                    .then(function (pushSubscription) {
                        return pushSubscription;
                    });
            }

            setTimeout(() => {
                requestPermission().then(() => {
                    subscribeUserToPush().then(result => {
                        updateSubscription(result)
                    })
                }, {{ $site->delay }});
            }).catch(error => {
                console.log("error accesses to notification !!!@#!@#")
            })
        }
    });
</script>
