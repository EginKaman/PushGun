(window.onload = async function() {

    if ('safari' in window && 'pushNotification' in window.safari) {
        console.log('this is safaris')

        function checkRemotePermission(permissionData) {
            if (permissionData.permission === 'default') {
                // This is a new web service URL and its validity is unknown.
                window.safari.pushNotification.requestPermission(
                    'https://awery.workreports.pro', // The web service URL.
                    'web.pro.workreports.awery', // The Website Push ID.
                    {}, // Data that you choose to send to your server to help you identify the user.
                    checkRemotePermission // The callback function.
                );
            } else if (permissionData.permission === 'denied') {
                console.log('user not allowed notifications')
            } else if (permissionData.permission === 'granted') {
                // The web service URL is a valid push provider, and the user said yes.
                // permissionData.deviceToken is now available to use.
                console.log(permissionData.deviceToken, 'YEAH!');
                // $rootScope.sendTokenToServer(permissionData.deviceToken, 'safari');
            }
        };

        function isTokenSentToServer(currentToken) {
            return window.localStorage.getItem('sentFirebaseMessagingToken') == currentToken;
        }

        function setTokenSentToServer(currentToken) {
            window.localStorage.setItem(
                'sentFirebaseMessagingToken',
                currentToken ? currentToken : ''
            );
        }

        function sendTokenToServer(currentToken) {
            if (!isTokenSentToServer(currentToken)) {
                console.log('Отправка токена на сервер...');
                var url = ''; // адрес скрипта на сервере который сохраняет ID устройства
                // Отправка на сервер
                setTokenSentToServer(currentToken);
            } else {
                console.log('Токен уже отправлен на сервер.');
            }
        }
        // var permissionData = window.safari.pushNotification.permission('web.com.example.domain')
        // checkRemotePermission(permissionData)7

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
            return new Promise(function(resolve, reject) {
                    const permissionResult = Notification.requestPermission(function(result) {
                        // Поддержка устаревшей версии с функцией обратного вызова.
                        resolve(result);
                    });

                    if (permissionResult) {
                        permissionResult.then(resolve, reject);
                    }
                })
                .then(function(permissionResult) {
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
                .then(function(registration) {
                    var subscribeOptions = {
                        userVisibleOnly: true,
                        applicationServerKey: urlBase64ToUint8Array(
                            'APP_KEY'
                        )
                    };
                    return registration.pushManager.subscribe(subscribeOptions);
                })
                .then(function(pushSubscription) {
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