self.addEventListener('push', function (event) {
    let data = {}
    if (event.data) {
        data = event.data.json()
    }
    // console.log('Push message received', event);
    // console.log(data);
    const title = data.title || "default title"
    const options = {
        body: data.body,
        icon: data.icon,
        data: data.data,
        actions: data.actions,
        options: data.options
    }
    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
})
