<!DOCTYPE html>
<html>
<head>
    <title>LINE Notify Example</title>
</head>
<body>
    <h1>LINE Notify Example</h1>
    <form id="lineNotifyForm">
        <label for="accessToken">Access Token:</label>
        <input type="text" id="accessToken" name="accessToken" required><br><br>
        
        <label for="message">Message:</label>
        <input type="text" id="message" name="message" required><br><br>
        
        <label for="stickerPackageId">Sticker Package ID:</label>
        <input type="text" id="stickerPackageId" name="stickerPackageId"><br><br>
        
        <label for="stickerId">Sticker ID:</label>
        <input type="text" id="stickerId" name="stickerId"><br><br>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image"><br><br>
        
        <button type="button" id="sendButton">Send to LINE Notify</button>
    </form>
    <div id="output"></div>

    <script>
        const sendButton = document.getElementById('sendButton');
        const lineNotifyForm = document.getElementById('lineNotifyForm');
        const output = document.getElementById('output');

        sendButton.addEventListener('click', () => {
            const formData = new FormData(lineNotifyForm);

            fetch('apiline.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.status === 200) {
                    return response.text();
                } else {
                    throw new Error('Failed to send message to LINE Notify');
                }
            })
            .then(data => {
                output.textContent = 'Message sent successfully!';
            })
            .catch(error => {
                console.error('Error:', error);
                output.textContent = 'Failed to send message to LINE Notify';
            });
        });
    </script>
</body>
</html>
