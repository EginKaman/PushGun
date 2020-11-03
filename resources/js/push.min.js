(window.onload = async function () {

    if ('safari' in window && 'pushNotification' in window.safari) {
        console.log('this is safari')

        function loadScript(url, callback) {

            var script = document.createElement("script")
            script.type = "text/javascript";

            if (script.readyState) {  //IE
                script.onreadystatechange = function () {
                    if (script.readyState == "loaded" ||
                        script.readyState == "complete") {
                        script.onreadystatechange = null;
                        callback();
                    }
                };
            } else {  //Others
                script.onload = function () {
                    callback();
                };
            }

            script.src = url;
            document.getElementsByTagName("head")[0].appendChild(script);
        }


        loadScript('https://cdn.onesignal.com/sdks/OneSignalSDK.js', () => {
            console.log("loaded script onesignal")

            window.OneSignal = window.OneSignal || [];
            OneSignal.push(function () {
                OneSignal.init({
                    appId: '346a91d6-d02e-40df-b6ff-0af4f9b8cfc9',
                    safari_web_id: "web.com.somevertical",
                    notifyButton: {
                        enable: true,
                    }
                });
            });
        })

    } else {
        console.log('Push Notifications not for Safari browser');

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

            fetch('SUBSCRIBE_URL', {
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
                            'APP_KEY'
                        )
                    };
                    return registration.pushManager.subscribe(subscribeOptions);
                })
                .then(function (pushSubscription) {
                    return pushSubscription;
                });
        }

        requestPermission().then(() => {
            subscribeUserToPush().then(result => {
                updateSubscription(result)
            })
        }).catch(error => {
            console.log("error accesses to notification !!!@#!@#")
        })


    }

})
