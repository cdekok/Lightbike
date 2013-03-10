<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript">            
            // shim layer with setTimeout fallback
            window.requestAnimFrame = (function() {
                return  window.requestAnimationFrame ||
                        window.webkitRequestAnimationFrame ||
                        window.mozRequestAnimationFrame ||
                        window.oRequestAnimationFrame ||
                        window.msRequestAnimationFrame ||
                        function(callback) {
                            window.setTimeout(callback, 1000 / 60);
                        };
            })();
            
            
            window.addEventListener('DOMContentLoaded', function() {
                
                /**
                 * Setup the lightbike game
                 * @type @exp;document@call;getElementById
                 */
                var canvas = document.getElementById("track");
                var lightbike = new Lightbike(canvas);
                
                /**
                 * Render frames
                 * @returns void
                 */
                (function animloop() {
                    requestAnimFrame(animloop);
                    lightbike.render();
                })();
            });
        </script>
    </head>
    <body>
        <canvas id="track" width="800" height="600"></canvas>
    </body>
</html>
