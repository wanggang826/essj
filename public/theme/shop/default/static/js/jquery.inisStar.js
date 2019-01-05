
/**
 * Created by Administrator on 2017/6/16 0016.
 */
$.fn.initStar = function(config_user){
    var _config = {
            width   : 30,
            height  : 22,
            starNum : 5,
            score   : 0      //分数初始化
        },
        html    = '',
        bg_odd  = "-" + (_config.width/2) + "px 0",
        bg_size = _config.width + "px " + _config.height + "px";
    _config = $.extend(_config, config_user);


    for (var i = 0; i < _config.starNum * 2; i++) {
        html += "<li></li>";
    }
    $(this).append(html);
    $(this).find('li').css({
        'width'      : _config.width/2,
        'height'     : _config.height,
        'display'    : 'block',
        'list-style' : 'none',
        'float'      : 'left',
        'box-sizing' : 'border-box',
        'background' : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAYAAAAnzezqAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RTJEODQzOEE0RkQ5MTFFN0IyODA4MEE3NTRDNTA2RUYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RTJEODQzOEI0RkQ5MTFFN0IyODA4MEE3NTRDNTA2RUYiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpFMkQ4NDM4ODRGRDkxMUU3QjI4MDgwQTc1NEM1MDZFRiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpFMkQ4NDM4OTRGRDkxMUU3QjI4MDgwQTc1NEM1MDZFRiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PpOk4eEAAAHeSURBVHjavJZLKIRRFICNsLKgvAsLUaJGs5EoWVpZWNgoSbMQCyUrodiwskek5LWShTCRKTaYyZsdNmJFichjfEdncRPm///5ufV1bjPnnue9Z8YTiUTinKxwOJyFOAcxkOrz+Z6d2ImPc77aYRbmoNupEY+TCpB9DmIbKvWjXSilCjf/VYFWWMHhpcB+ETr+pQVkn4nwQ7/xsewb9bs/r4BkuqSZfy7dr0KLXWMJUbJNRhRBtfiBPKiAwm/UpQrHnKlFnsIZbEKIAN9sXUKMjCHq4QWOYA/uICgSg/s/BOxFpGjAIsvAq4kucK7JagVq5LBZZivLCCz4JbB8xI6dOzAKW5pRTEttyDPtsxwAmQzqoAnEEoSenYdOGLE9iDDg1ylX91PfozgPyKvh7LSjZ8hBaUWXDBo7lVBdGdNy6WZ+VZYKRCMUCvlh3Yqu6q9BgxVdq4MoES5sdEBez7ubk7BKjVpdEmy5mwEUwIaNAGQOlMQ8io2Vq9PQvGjV+rblGfVzYc3hI7rFrvwfwFES4goHaYbjHkiHAXiFXrg1A0Hvmn2WGxUQIwc6TschG4ZhGgcP6mwZ0QAT7KX/zXDiVgvkBylD+zoEUzi+/zIvnhCTAgG0IQ/h0UoAHwIMAIw4D0LLaXI0AAAAAElFTkSuQmCC) no-repeat center',
        'background-size': bg_size
    });
    for (var i = 0; i < (_config.score*2); i++) {
        $(this).find('li').eq(i).css({
            'background' : 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAYAAAAnzezqAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6REFDRjY5RkM0RkQ5MTFFNzkzRUJGNzk2MUFCQTA3NzEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6REFDRjY5RkQ0RkQ5MTFFNzkzRUJGNzk2MUFCQTA3NzEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpEQUNGNjlGQTRGRDkxMUU3OTNFQkY3OTYxQUJBMDc3MSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpEQUNGNjlGQjRGRDkxMUU3OTNFQkY3OTYxQUJBMDc3MSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PkuX3M4AAAEXSURBVHjaxFXNDYIwGC0NdxyBDagTiBt48awjOAKO4AZy1SHEDXQDR4ABBF+Tj6QhUFpa8EteyqH0ve+fNU3DpuJ7CwogdnmDs4lW33mKYwNkzMG4w78t8QFi4kUFKN53xSwWgS7h5ChwD947RYFbkscaIhmFna2AQLbCgJcCWAEpnYnFuxXwAj4E+V3yfV10L4YDDzyYm0WUJjVVOVCYpmBNXviyHN4fjWsAl18U+mpOcm0RehKhJR/tAkcRo+RGbUgibNvrYkLuugt0FvseROLfAmznfLJUBN5DBYppKuYU8AS2KDRB0Tn3CPEjgBZQ1CFO27mOU874TBFilbbQMP8y1Ke+ZaK0ayk3JQRfaWOmJgJ+AgwASDO2htqG4NYAAAAASUVORK5CYII=) no-repeat center',
            'background-size': bg_size
        })
    }
    $(this).find('li:even').css({
        'background-position':"0 0"
    })
    $(this).find('li:odd').css({
        'background-position':bg_odd
    })
}





















