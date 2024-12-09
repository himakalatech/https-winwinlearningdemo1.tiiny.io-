

<footer class="footer">
2024 © All Rights Reserved by Winwin learn | Developed by <u><a href="https://www.kalatech.co.in/" class="text-decoration-none text-white">KalaTech</u></a>
</footer>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>
        // Function to open the popup
        function openPopup(pageUrl) {
            //var popupOverlay = document.getElementById('popupOverlay');
            var popupOverlay = this.getElementById('popupOverlay');
            var popupContent = document.getElementById('popupContent');
            // Load the content of the pageUrl into the popupContent
            popupContent.innerHTML = '<object type="text/html" data="' + pageUrl + '" style="width:100%; height:100%;"></object>';
            // Show the popup
            popupOverlay.style.display = 'block';
        }

        function closePopup() {
            var popupOverlay = document.getElementById('popupOverlay');
            // Hide the popup
            popupOverlay.style.display = 'none';
        }
      
        // Close the popup when user clicks outside the popup content
        window.onclick = function(event) {
            var popupOverlay = document.getElementById('popupOverlay');
            if (event.target == popupOverlay) {
                popupOverlay.style.display = "none";
            }
        };
    </script>
</body>
</html>