/*
 * Lightbike
 * 
 * @author Chris de Kok <chris.de.kok@gmail.com>
 */

/**
 * 
 * @param {element} canvas
 * @returns {Lightbike}
 */
var Lightbike = function(canvas) {
    this.canvas = canvas;
    this.direction = 40;
    this.options = {
        distance: 1
    };
    this.pos = {
        x: 0,
        y: 0
    };

    if (window.DeviceOrientationEvent) {
        //window.addEventListener("devicemotion", this._devicemotion.bind(this));
        window.addEventListener('keydown', this._keydown.bind(this));
    } else {
        window.addEventListener('keydown', this._keydown.bind(this));
    }
};

/**
 * Render frame
 * @returns {void}
 */
Lightbike.prototype.render = function() {
    this.move(1);
};

/**
 * Move point certain distance
 * @returns {void}
 */
Lightbike.prototype.move = function() {
    var radian = this.direction * Math.PI / 180;
    var x = this.pos.x;
    var y = this.pos.y;
    x += Math.cos(radian) * this.options.distance;
    y += Math.sin(radian) * this.options.distance;

    var ctx = this.canvas.getContext("2d");
    ctx.moveTo(this.pos.x, this.pos.y);
    ctx.strokeStyle = '#B60094';
    ctx.lineCap = 'round';
    ctx.lineTo(this.pos.x = x, this.pos.y = y);
    ctx.stroke();
};

/**
 * Rotate direction
 * @param {float} degree
 * @returns {void}
 */
Lightbike.prototype.rotate = function(degree) {
    this.direction += degree;
};

/**
 * Key down event
 * @param {type} e
 * @returns {void}
 */
Lightbike.prototype._keydown = function(e) {
    switch (e.keyCode) {
        case 37:
            // Go left
            this.rotate(-15);
            break;
        case 39:
            // Go right
            this.rotate(15);
            break;
    }
};

/**
 * Key down event
 * @param {type} e
 * @returns {void}
 */
Lightbike.prototype._devicemotion = function(e) {

    if (e.acceleration.x > 0) {
        this.rotate(15);
    } else if (e.acceleration.x < 0) {
        this.rotate(-15);
    }
};