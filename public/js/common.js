history.pushState(null, null, location.href);
$(window).on('popstate', function(){
  history.go(1);
});

var Common = {
/**
 * 日付をフォーマットする
 * @param  {Date}   date     日付
 * @param  {string} [format] フォーマット
 * @return {string}          フォーマット済み日付
 */
 formatDate : function (date, format) {
    if (!format) format = 'YYYY-MM-DD hh:mm:ss.SSS';
    format = format.replace(/YYYY/g, date.getFullYear());
    format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
    format = format.replace(/DD/g, ('0' + date.getDate()).slice(-2));
    format = format.replace(/hh/g, ('0' + date.getHours()).slice(-2));
    format = format.replace(/mm/g, ('0' + date.getMinutes()).slice(-2));
    format = format.replace(/ss/g, ('0' + date.getSeconds()).slice(-2));
    if (format.match(/S/g)) {
      var milliSeconds = ('00' + date.getMilliseconds()).slice(-3);
      var length = format.match(/S/g).length;
      for (var i = 0; i < length; i++) format = format.replace(/S/, milliSeconds.substring(i, i + 1));
    }
    return format;
  },
  /**
   * 指定のミリ秒待機します
   * @param {string} waitMilliSec 
   * @param {function} callbackFunc 
   */
  sleep : function(waitMilliSec, callbackFunc){
    var spanedSec = 0;
    var addMilli = 100;
    var waitFunc = function () {
        spanedSec+=addMilli;
        if (spanedSec >= waitMilliSec) {
            if (callbackFunc) callbackFunc();
            return;
        }
        clearTimeout(id);
        id = setTimeout(waitFunc, addMilli);
    };
    var id = setTimeout(waitFunc, addMilli);
  },
  /**
   * モーダルダイアログを閉じます
   * @param {string} dialogid progress, info, okcancel
   */
  closeDialog : function(dialogid){
    if(dialogid == null){
      $('#progress-modal').modal('hide');
      $('#info-modal').modal('hide');
      $('#okcancel-modal').modal('hide');
    }else{
      if(dialogid == 'progress-modal' || dialogid == 'progress'){
        modalId = '#progress-modal'
      }
  
      if(dialogid == 'info-modal' || dialogid == 'info'){
        modalId = '#info-modal'
      }
      if(dialogid == 'okcancel-modal' || dialogid == 'okcancel'){
        modalId = '#okcancel-modal'
      }
      $(modalId).modal('hide');
    }
  },
  /**
   * モーダルダイアログを表示します
   * @param {string} mode primary, info, warning, danger, success 
   * @param {string} dialogid progress, info, okcancel
   * @param {string} title title
   * @param {string} message message
   * @param {string} okButtonMessage buttonmessage
   */
  showDialog : function(mode, dialogid, title, message, okButtonMessage){
    if(mode == null){
      mode = 'info';
    }
    var modePattern = {primary: 'primary', info: 'info', warning: 'warning', danger: 'danger', success: 'success'};
    var iconPattern = {danger: 'fa-exclamation-circle',success: 'fa-check-circle', warning: 'fa-exclamation-triangle', primary: 'fa-info-circle', info: 'fa-info-circle'};
    var modalId = 'info-modal';

    if(dialogid == 'progress-modal' || dialogid == 'progress'){
      modalId = '#progress-modal'
    }
    if(dialogid == 'info-modal' || dialogid == 'info'){
      modalId = '#info-modal'
    }
    if(dialogid == 'okcancel-modal' || dialogid == 'okcancel'){
      modalId = '#okcancel-modal'
    }
    if($(modalId + '-spinner').length){
      for (var p in modePattern) {
        $(modalId + '-spinner').removeClass('text-' + p);
      }
      $(modalId + '-spinner').addClass('text-' + modePattern[mode]);
    }
    if($(modalId + '-title').length){
      $(modalId + '-title').html(title);
    }
    if($(modalId + '-message').length){
      $(modalId + '-message').html(message);
    }

    if($(modalId + '-icon').length){
      for (var p in iconPattern) {
        $(modalId + '-icon').removeClass(p);
      }
      $(modalId + '-icon').addClass(iconPattern[mode]);
      
      for (var p in modePattern) {
        $(modalId + '-icon').removeClass('text-' + p);
      }
      $(modalId + '-icon').addClass('text-' + modePattern[mode]);
    }

    if($(modalId + '-ok-button').length){
      $(modalId + '-ok-button').html('OK');
      for (var p in modePattern) {
        $(modalId + '-ok-button').removeClass('btn-' + p);
      }
      $(modalId + '-ok-button').addClass('btn-' + modePattern[mode]);
      if(okButtonMessage!=null){
        $(modalId + '-ok-button').html(okButtonMessage);
      }
    }

    if($(modalId + '-header').length){
      for (var p in modePattern) {
        $(modalId + '-header').removeClass('bg-' + p);
      }
      $(modalId + '-header').addClass('bg-' + modePattern[mode]);
    }

    $(modalId).modal({
      backdrop: 'static',
      keyboard: false
    });
  },downloadPdf : function(url, methodType, data){
    Common.showDialog('info', 'progress', 'PDFファイルのダウンロード中...','しばらくお待ちください。', null, null);
        
        let fnGetFileNameFromContentDispostionHeader = function (header) {
            let contentDispostion = header.split(';');
            const fileNameToken = "filename*=UTF-8''";
        
            let fileName = 'downloaded.pdf';
            for (let thisValue of contentDispostion) {
                if (thisValue.trim().indexOf(fileNameToken) === 0) {
                    fileName = decodeURIComponent(thisValue.trim().replace(fileNameToken, ''));
                    break;
                }
            }
            return fileName;
        };

        Common.sleep(1000, function(){
            fetch(url, {
                method: methodType,
                headers: {
                    'Content-Type': 'application/json; charset=utf-8'
                },
                body: data,
            })
                .then(async res => ({
                    filename: fnGetFileNameFromContentDispostionHeader(res.headers.get('Content-Disposition')),
                    blob: await res.blob()
                }))
                .then(resObj => {
                    // It is necessary to create a new blob object with mime-type explicitly set for all browsers except Chrome, but it works for Chrome too.
                    const newBlob = new Blob([resObj.blob], { type: 'application/pdf' });
            
                    // MS Edge and IE don't allow using a blob object directly as link href, instead it is necessary to use msSaveOrOpenBlob
                    if (window.navigator && window.navigator.msSaveOrOpenBlob) {
                        window.navigator.msSaveOrOpenBlob(newBlob);
                    } else {
                        // For other browsers: create a link pointing to the ObjectURL containing the blob.
                        const objUrl = window.URL.createObjectURL(newBlob);
            
                        let link = document.createElement('a');
                        link.href = objUrl;
                        link.download = resObj.filename;
                        link.click();
            
                        // For Firefox it is necessary to delay revoking the ObjectURL.
                        setTimeout(() => { window.URL.revokeObjectURL(objUrl); }, 250);
                    }
                    
                    Common.closeDialog('progress');
                })
                .catch((error) => {
                    console.log('DOWNLOAD ERROR', error);
                    Common.closeDialog('progress');
                });
        });
  }
}
