const qrCodeSuccessCallback = (decodedText, decodedResult) => {
    // Set the value of the hidden input field
    document.getElementById('qrCodeInput').value = decodedText;

    // Submit the form
    document.getElementById('qr-form').submit();

    html5QrCode.stop().then(ignore => {
        console.log("QR Code scanning stopped");
        document.getElementById("reader").style.display = 'none';
        document.getElementById("loading").style.display = 'block';
    }).catch(err => {
        // Stop failed, handle it.
    });
};

// Initialize the QR code scanner
const html5QrCode = new Html5Qrcode("reader");
html5QrCode.start(
    { facingMode: "environment" }, // use the rear camera
    {
        fps: 10,    // frame per second
    },
    qrCodeSuccessCallback
).catch(err => {
    console.error("Error starting QR code scan:", err);
});