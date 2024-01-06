<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        {{-- {{ $getState() }} --}}
        @php
            $url = url('/profile/'. $getState())
        @endphp
       <div id="qrcode">
        {!! QrCode::size(500)->generate($url); !!}
       </div>
        
        <div style=" padding-top:2rem;">
            <button onclick="download()" class="button-3" role="button">Download</button>
        </div>


        <script>
    //         function download() {
    //     // Get the SVG content
    //     var svgContent = document.getElementById('qrcode').innerHTML;

    //     // Create a Blob from the SVG content
    //     var blob = new Blob([svgContent], { type: 'image/svg+xml' });

    //     // Create a link element
    //     var link = document.createElement('a');

    //     // Set the href attribute to a Blob URL
    //     link.href = window.URL.createObjectURL(blob);

    //     // Set the download attribute with the desired file name
    //     link.download = 'qrcode.svg';

    //     // Append the link to the document
    //     document.body.appendChild(link);

    //     // Trigger a click on the link to start the download
    //     link.click();

    //     // Remove the link from the document
    //     document.body.removeChild(link);
    // }

    function download() {
        // Get the SVG content
        var svgContent = document.getElementById('qrcode').innerHTML;

        // Create a new Image element
        var img = new Image();

        // Create a Blob from the SVG content
        var blob = new Blob([svgContent], { type: 'image/svg+xml' });

        // Create a data URL from the Blob
        var url = URL.createObjectURL(blob);

        // Set the Image source to the SVG data URL
        img.src = url;

        // Wait for the Image to load
        img.onload = function () {
            // Create a canvas element
            var canvas = document.createElement('canvas');
            var context = canvas.getContext('2d');

            // Set the canvas size to match the Image size
            canvas.width = img.width;
            canvas.height = img.height;

            // Draw the Image on the canvas
            context.drawImage(img, 0, 0);

            // Convert the canvas content to a data URL (PNG format)
            var dataUrl = canvas.toDataURL('image/png');

            // Create a link element
            var link = document.createElement('a');

            // Set the href attribute to the data URL
            link.href = dataUrl;

            // Set the download attribute with the desired file name
            link.download = 'qrcode.png';

            // Append the link to the document
            document.body.appendChild(link);

            // Trigger a click on the link to start the download
            link.click();

            // Remove the link from the document
            document.body.removeChild(link);

            // Revoke the Object URL to free up resources
            URL.revokeObjectURL(url);
        };
    }
        </script>
    </div>
</x-dynamic-component>


<style>
 


/* CSS */
.button-3 {
  appearance: none;
  background-color: #2ea44f;
  border: 1px solid rgba(27, 31, 35, .15);
  border-radius: 6px;
  box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
  font-size: 14px;
  font-weight: 600;
  line-height: 20px;
  padding: 6px 16px;
  position: relative;
  text-align: center;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
  white-space: nowrap;
}

.button-3:focus:not(:focus-visible):not(.focus-visible) {
  box-shadow: none;
  outline: none;
}

.button-3:hover {
  background-color: #2c974b;
}

.button-3:focus {
  box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
  outline: none;
}

.button-3:disabled {
  background-color: #94d3a2;
  border-color: rgba(27, 31, 35, .1);
  color: rgba(255, 255, 255, .8);
  cursor: default;
}

.button-3:active {
  background-color: #298e46;
  box-shadow: rgba(20, 70, 32, .2) 0 1px 0 inset;
}
</style>