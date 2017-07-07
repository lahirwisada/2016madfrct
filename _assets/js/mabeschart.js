(function () {
    function createCanvas(width, height) {
        var canvas = document.createElement("canvas");
        canvas.setAttribute("class", "mabes-chart");
        canvas.width = width;
        canvas.height = height;
        return canvas;
    }
    function setFont(context, font, size) {
        context.font = size + "px " + font;
    }
    function drawText(context, text, color, align, start, top) {
        context.fillStyle = color;
        context.textAlign = align;
        context.fillText(text, start, top);
    }
    function drawLine(context, start, end, top, size) {
        context.lineWidth = size;
        context.beginPath();
        context.moveTo(start, top);
        context.lineTo(end, top);
        context.stroke();
    }
    function drawSegitiga(context, sl, lc, bg, bgc, x1, y1, x2, y2, x3, y3) {
        context.beginPath();
        context.moveTo(x1, y1);
        context.lineTo(x2, y2);
        context.lineTo(x3, y3);
        context.closePath();
        if (bg) {
            context.fillStyle = bgc;
            context.fill();
        }
        if (sl > 0) {
            context.lineWidth = sl;
            context.strokeStyle = lc;
            context.stroke();
        }
    }
    function addEvent(obj, eventType, fn, useCapture) {
        if (obj.addEventListener) {
            obj.addEventListener(eventType, fn, useCapture || false);
        } else if (obj.attachEvent) {
            obj.attachEvent("on" + eventType, function (e) {
                e = e || window.event;
                e.preventDefault = e.preventDefault || function () {
                    e.returnValue = false;
                };
                e.stopPropagation = e.stopPropagation || function () {
                    e.cancelBubble = true;
                };
                fn.call(obj, e);
            });
        } else
            return false;
    }

    function MabesChart(containerId, options) {
        this._options = options;
        this._chartWidth = 1100;
        this._chartHeight = 1500;
        var _this = this;
        this._containerId = containerId;
        addEvent(window, "resize", function () {
            if (_this._updateSize())
                _this.render();
        });
    }
    MabesChart.prototype._updateSize = function () {
        var width = 0;
        var height = 0;
        this.width = width = this._container.clientWidth > 0 ? this._container.clientWidth : this.width;
        this.height = height = this._container.clientHeight > 0 ? this._container.clientHeight : this.height;
        if (this.canvas.width !== width || this.canvas.height !== height) {
            this.canvas.width = width;
            this.canvas.height = height;
            return true;
        }
        return false;
    };
    MabesChart.prototype.render = function () {
        var data = this._options;
        var jumlahPangkat = data.pangkat.length;
        if (jumlahPangkat > 0) {
            this._container = typeof (this._containerId) === "string" ? document.getElementById(this._containerId) : this._containerId;
            this._container.innerHTML = "";
            this._mabesChartContainer = document.createElement("div");
            this._mabesChartContainer.setAttribute("class", "mabes-chart-container");
            this._mabesChartContainer.style.position = "relative";
            this._mabesChartContainer.style.textAlign = "left";
            this._mabesChartContainer.style.cursor = "auto";
            this._container.appendChild(this._mabesChartContainer);

            var scale = Math.round(this._mabesChartContainer.clientWidth / this._chartWidth);
            if (scale === 0)
                scale = 1;
//        console.log(scale);

            this.canvas = createCanvas(this._chartWidth * scale, this._chartHeight * scale);
            this.canvas.style.width = '100%';
            this._mabesChartContainer.appendChild(this.canvas);

            var context = this.canvas.getContext("2d");
            var lebar = this._chartWidth * scale;
            var jarak = 70 * scale;
            var titleTop = 90 * scale;
            var segitigaTop = 140 * scale;
            var garisTop = 170 * scale;
            var pangkatTop = garisTop + jarak / 2 + 10;
            var kiriGambar = 100 * scale;
            var kananGambar = lebar;
            var lebarGambar = kananGambar - kiriGambar;
            var tengahGambar = kiriGambar + lebarGambar / 2;
            var tebalBar = jarak / 2;

            var scale10 = 10 * scale;
            var scale15 = 15 * scale;
            var scale20 = 20 * scale;
            var scale25 = 25 * scale;

            // header
            setFont(context, "Arial Narrow", 14 * scale);
            drawText(context, "MARKAS BESAR ANGKATAN DARAT", "black", "center", 120 * scale, scale20);
            drawText(context, "STAF UMUM PERSONEL", "black", "center", 120 * scale, 34 * scale);
            drawLine(context, scale10, 230 * scale, 40 * scale, 1 * scale);

            // judul
            setFont(context, "Arial", 22 * scale);
            drawText(context, "PIRAMIDA KEKUATAN PERSONEL", "black", "center", tengahGambar, titleTop);
            drawText(context, data.struktur + " STRUKTUR TNI AD TW " + data.triwulan + " TAHUN " + data.tahun, "black", "center", tengahGambar, titleTop + scale20);

            // bayangan segitiga
            drawSegitiga(context, 0, null, true, "#CCCCCC", tengahGambar, segitigaTop - scale20, kiriGambar + 88 * scale, garisTop + jumlahPangkat * jarak + 8 * scale, kananGambar - 88 * scale, garisTop + jumlahPangkat * jarak + 8 * scale);

            // segitiga
            drawSegitiga(context, 3 * scale, '#000000', true, "#33AA33", tengahGambar, segitigaTop, kiriGambar + 100 * scale, garisTop + jumlahPangkat * jarak, kananGambar - 100 * scale, garisTop + jumlahPangkat * jarak);

            // garis tengah
            context.beginPath();
            context.lineWidth = 1 * scale;
            context.moveTo(tengahGambar, segitigaTop + 30 * scale);
            context.lineTo(tengahGambar, garisTop + jumlahPangkat * jarak);
            context.stroke();

            // garis pangkat
            context.setLineDash([10, 5]);
            context.lineWidth = 1 * scale;
            for (i = 0; i <= jumlahPangkat; i++) {
                context.beginPath();
                context.moveTo(10, garisTop + i * jarak);
                context.lineTo(kananGambar - scale10, garisTop + i * jarak);
                context.stroke();
            }

            // garis perwira
            context.beginPath();
            context.setLineDash([2]);
            context.moveTo(tengahGambar - 300 * scale, (garisTop + scale10));
            context.lineTo(tengahGambar - 300 * scale, (garisTop + scale10) + 9 * jarak - scale15);
            context.lineTo(tengahGambar + 300 * scale, (garisTop + scale10) + 9 * jarak - scale15);
            context.lineTo(tengahGambar + 300 * scale, (garisTop + scale10));
            context.stroke();

            // garis bintara
            context.beginPath();
            context.moveTo(tengahGambar - 300 * scale, (garisTop + scale10) + 9 * jarak);
            context.lineTo(tengahGambar - 300 * scale, (garisTop + scale10) + 12 * jarak - scale15);
            context.lineTo(tengahGambar + 300 * scale, (garisTop + scale10) + 12 * jarak - scale15);
            context.lineTo(tengahGambar + 300 * scale, (garisTop + scale10) + 9 * jarak);
            context.stroke();

            // garis tamtama
            context.beginPath();
            context.moveTo(tengahGambar - 300 * scale, (garisTop + scale10) + 12 * jarak);
            context.lineTo(tengahGambar - 300 * scale, (garisTop + scale10) + 14 * jarak - scale15);
            context.lineTo(tengahGambar + 300 * scale, (garisTop + scale10) + 14 * jarak - scale15);
            context.lineTo(tengahGambar + 300 * scale, (garisTop + scale10) + 12 * jarak);
            context.stroke();

            // garis pati
            context.beginPath();
            context.moveTo(tengahGambar - 200 * scale, (garisTop + scale10) + 4 * jarak - scale20);
            context.lineTo(tengahGambar + 200 * scale, (garisTop + scale10) + 4 * jarak - scale20);
            context.stroke();

            // garis pamen
            context.beginPath();
            context.moveTo(tengahGambar - 200 * scale, (garisTop + scale10) + 7 * jarak - scale20);
            context.lineTo(tengahGambar + 200 * scale, (garisTop + scale10) + 7 * jarak - scale20);
            context.stroke();

            // garis pama
            context.beginPath();
            context.moveTo(tengahGambar - 130 * scale, (garisTop) + 9 * jarak - tebalBar);
            context.lineTo(tengahGambar + 130 * scale, (garisTop) + 9 * jarak - tebalBar);
            context.stroke();

            // segitiga perwira
            context.setLineDash([]);
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar - 300 * scale, garisTop + scale10, tengahGambar - 305 * scale, garisTop + scale20, tengahGambar - 295 * scale, garisTop + scale20);
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar + 300 * scale, garisTop + scale10, tengahGambar + 305 * scale, garisTop + scale20, tengahGambar + 295 * scale, garisTop + scale20);

            // segitiga pati
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar - 200 * scale, (garisTop + scale10) + 4 * jarak - scale20, tengahGambar - 190 * scale, (garisTop + 5 * scale) + 4 * jarak - scale20, tengahGambar - 190 * scale, (garisTop + scale15) + 4 * jarak - scale20);
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar + 200 * scale, (garisTop + scale10) + 4 * jarak - scale20, tengahGambar + 190 * scale, (garisTop + 5 * scale) + 4 * jarak - scale20, tengahGambar + 190 * scale, (garisTop + scale15) + 4 * jarak - scale20);

            // segitiga pamen
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar - 200 * scale, (garisTop + scale10) + 7 * jarak - scale20, tengahGambar - 190 * scale, (garisTop + 5 * scale) + 7 * jarak - scale20, tengahGambar - 190 * scale, (garisTop + scale15) + 7 * jarak - scale20);
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar + 200 * scale, (garisTop + scale10) + 7 * jarak - scale20, tengahGambar + 190 * scale, (garisTop + 5 * scale) + 7 * jarak - scale20, tengahGambar + 190 * scale, (garisTop + scale15) + 7 * jarak - scale20);

            // segitiga pama
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar - 130 * scale, (garisTop + 0) + 9 * jarak - tebalBar, tengahGambar - 120 * scale, (garisTop - 5 * scale) + 9 * jarak - tebalBar, tengahGambar - 120 * scale, (garisTop + 5 * scale) + 9 * jarak - tebalBar);
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar + 130 * scale, (garisTop + 0) + 9 * jarak - tebalBar, tengahGambar + 120 * scale, (garisTop - 5 * scale) + 9 * jarak - tebalBar, tengahGambar + 120 * scale, (garisTop + 5 * scale) + 9 * jarak - tebalBar);

            // segitiga bintara
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar - 300 * scale, (garisTop + scale10) + 9 * jarak, tengahGambar - 305 * scale, (garisTop + scale20) + 9 * jarak, tengahGambar - 295 * scale, (garisTop + scale20) + 9 * jarak);
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar + 300 * scale, (garisTop + scale10) + 9 * jarak, tengahGambar + 305 * scale, (garisTop + scale20) + 9 * jarak, tengahGambar + 295 * scale, (garisTop + scale20) + 9 * jarak);

            // segitiga tamtama
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar - 300 * scale, (garisTop + scale10) + 12 * jarak, tengahGambar - 305 * scale, (garisTop + scale20) + 12 * jarak, tengahGambar - 295 * scale, (garisTop + scale20) + 12 * jarak);
            drawSegitiga(context, 0, null, true, "#000000", tengahGambar + 300 * scale, (garisTop + scale10) + 12 * jarak, tengahGambar + 305 * scale, (garisTop + scale20) + 12 * jarak, tengahGambar + 295 * scale, (garisTop + scale20) + 12 * jarak);

            // data grafik
            for (i = 0; i < jumlahPangkat; i++) {
                jmlNyata = (data.pangkat[i].nyata / 150000 * 500 * scale);
                jmlTop = (data.pangkat[i].top / 150000 * 500 * scale);
                setFont(context, "Agency FB", 24 * scale);
                drawText(context, data["pangkat"][i].label, "black", "left", scale20, pangkatTop + i * jarak);

                context.lineWidth = 1 * scale;

                context.beginPath();
                context.moveTo(tengahGambar - jmlNyata, garisTop + i * jarak);
                context.lineTo(tengahGambar - jmlNyata, garisTop + i * jarak + tebalBar);
                context.lineTo(tengahGambar + jmlNyata, garisTop + i * jarak + tebalBar);
                context.lineTo(tengahGambar + jmlNyata, garisTop + i * jarak);
                context.closePath();
                context.fillStyle = "#FFFFFF";
                context.fill();
                context.strokeStyle = '#000000';
                context.stroke();
                context.beginPath();
                context.moveTo(tengahGambar - jmlTop, garisTop + i * jarak + tebalBar);
                context.lineTo(tengahGambar - jmlTop, garisTop + i * jarak + tebalBar + tebalBar);
                context.lineTo(tengahGambar + jmlTop, garisTop + i * jarak + tebalBar + tebalBar);
                context.lineTo(tengahGambar + jmlTop, garisTop + i * jarak + tebalBar);
                context.closePath();
                context.fillStyle = "#000000";
                context.fill();
                context.strokeStyle = '#000000';
                context.stroke();

                setFont(context, "Agency FB", scale20);
                if (i > 9) {
                    drawText(context, data.pangkat[i].nyata.toLocaleString('id'), "black", "right", tengahGambar + jmlNyata - scale10, garisTop + i * jarak + scale25);
                    drawText(context, data.pangkat[i].top.toLocaleString('id'), "white", "left", tengahGambar - jmlTop + scale10, garisTop + i * jarak + tebalBar + scale25);
                } else {
                    drawText(context, data.pangkat[i].nyata.toLocaleString('id'), "black", "left", tengahGambar + jmlNyata + 5 * scale, garisTop + i * jarak + scale25);
                    drawText(context, data.pangkat[i].top.toLocaleString('id'), "white", "right", tengahGambar - jmlTop - 5 * scale, garisTop + i * jarak + tebalBar + scale25);
                }
            }

            // text pati
            setFont(context, "Agency FB", scale20);
            drawText(context, data.tingkat[0].label + " (" + data.tingkat[0].top.toLocaleString('id') + ")", "black", "center", tengahGambar - 200 * scale, garisTop + 4 * jarak - 30);
            drawText(context, data.tingkat[0].label + " (" + data.tingkat[0].nyata.toLocaleString('id') + ")", "black", "center", tengahGambar + 200 * scale, garisTop + 4 * jarak - 30);

            // text pamen
            drawText(context, data.tingkat[1].label + " (" + data.tingkat[1].top.toLocaleString('id') + ")", "black", "right", tengahGambar - 200 * scale, garisTop + 7 * jarak - 30);
            drawText(context, data.tingkat[1].label + " (" + data.tingkat[1].nyata.toLocaleString('id') + ")", "black", "left", tengahGambar + 200 * scale, garisTop + 7 * jarak - 30);

            // text pama
            drawText(context, data.tingkat[2].label + " (" + data.tingkat[2].top.toLocaleString('id') + ")", "black", "right", tengahGambar - 140 * scale, garisTop + 9 * jarak - 30);
            drawText(context, data.tingkat[2].label + " (" + data.tingkat[2].nyata.toLocaleString('id') + ")", "black", "left", tengahGambar + 140 * scale, garisTop + 9 * jarak - 30);

            // text perwira
            drawText(context, data.golongan[0].label, "black", "right", tengahGambar - 310 * scale, garisTop + tebalBar);
            drawText(context, "(" + data.golongan[0].top.toLocaleString('id') + ")", "black", "right", tengahGambar - 310 * scale, garisTop + tebalBar + scale20);
            drawText(context, data.golongan[0].label, "black", "left", tengahGambar + 310 * scale, garisTop + tebalBar);
            drawText(context, "(" + data.golongan[0].nyata.toLocaleString('id') + ")", "black", "left", tengahGambar + 310 * scale, garisTop + tebalBar + scale20);

            // text bintara
            drawText(context, data.golongan[1].label, "black", "right", tengahGambar - 310 * scale, garisTop + 9 * jarak + tebalBar);
            drawText(context, "(" + data.golongan[1].top.toLocaleString('id') + ")", "black", "right", tengahGambar - 310 * scale, garisTop + 9 * jarak + tebalBar + scale20);
            drawText(context, data.golongan[1].label, "black", "left", tengahGambar + 310 * scale, garisTop + 9 * jarak + tebalBar);
            drawText(context, "(" + data.golongan[1].nyata.toLocaleString('id') + ")", "black", "left", tengahGambar + 310 * scale, garisTop + 9 * jarak + tebalBar + scale20);

            // text tamtama
            drawText(context, data.golongan[2].label, "black", "right", tengahGambar - 310 * scale, garisTop + 12 * jarak + tebalBar);
            drawText(context, "(" + data.golongan[2].top.toLocaleString('id') + ")", "black", "right", tengahGambar - 310 * scale, garisTop + 12 * jarak + tebalBar + scale20);
            drawText(context, data.golongan[2].label, "black", "left", tengahGambar + 310 * scale, garisTop + 12 * jarak + tebalBar);
            drawText(context, "(" + data.golongan[2].nyata.toLocaleString('id') + ")", "black", "left", tengahGambar + 310 * scale, garisTop + 12 * jarak + tebalBar + scale20);
        }
    };
    window.MabesChart = MabesChart;
})();
