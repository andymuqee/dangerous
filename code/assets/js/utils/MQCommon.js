/**
 * Created by andywu on 16/3/17.
 */
var INFO = {};
INFO.SERVER = {};
INFO.SERVER.OVERTIME = '网络连接超时!';
INFO.SERVER.EXCEPTION = '服务器异常';
INFO.SERVER.ERROR = '服务器错误!';
//----------------------MQCommon------------------------------------
var MQCommon = MQC = {};
/**
 * api接口调用
 * @param method
 * @param param
 * @param cbSuccess
 * @param cbError
 */
MQCommon.api = function (method, param, cbSuccess, cbError) {
    $.ajax({
        type: "post",
        async: false,
        url: method,
        data: param,
        dataType: "json",
        success: cbSuccess,
        error: cbError
    });
};
/**
 * 解密
 * @param message
 * @param key
 * @returns {*}
 */
MQCommon.encryptByDES = function (message, key) {
    var keyHex = CryptoJS.enc.Utf8.parse(key);
    var encrypted = CryptoJS.DES.encrypt(message, keyHex, {
        mode: CryptoJS.mode.ECB,
        padding: CryptoJS.pad.Pkcs7
    });
    return encrypted.toString();
};

/**
 * 加密串
 * @param str
 */
MQCommon.key = function (val) {
    var key = "A1B2C3D4E5F60708";
    // str = 'callback=mqCallback&' + val;
    return this.encryptByDES(val, key);
};

MQCommon.mkParam = function (param) {
    var ret = [];
    var fmt = "{0}={1}";
    var i = 0;
    for (var attriName in param) {
        ret[i] = fmt.format(attriName, param[attriName]);
        i++;
    }
    tmp = "callback=callback&" + ret.join('&');
    return {string: MQCommon.key(tmp)};
};
/**
 * 生产local url
 * @param ctl
 * @param action
 * @param token
 * @param other
 * @returns {string}
 */
MQCommon.mkInterface = function (ctl, action, token, other) {
    return "/cgi-bin/app.lua?ctl={0}&action={1}&token={2}{3}".format(ctl, action, token, other);
};

/**
 * 本地api接口调用
 * @param ctl
 * @param action
 * @param param
 * @param cbSuccess
 * @param cbError
 */
MQCommon.localApi = function (url, param, cbSuccess, cbError) {
    $.ajax({
        type: "GET",
        url: url,
        data: param,
        dataType: "json",
        contentType: "application/json",
        beforeSend: function () {
            //alert('正在发送');
        },
        complate: function (e) {
            //alert('ok');
        },
        success: function (rtn) {
            switch (rtn.code) {
                case 500:
                    alert(rtn.msg);
                    break;
                case 400:
                    alert(rtn.msg);
                    cbSuccess(rtn);
                    break;
                case 401:
                    alert('错误,登录超时');
                    top.location.href = 'index.html';
                    break;
                default:
                    cbSuccess(rtn);
                    break;
            }

        },
        error: function (rtn) {
            //alert(INFO.SERVER.OVERTIME);
            cbError(rtn);
        }
    });
};
/**
 * 显示
 * @param id
 */
MQCommon.show = function (id) {
    id.css('display', 'block');
};
/**
 * 隐藏
 * @param id
 */
MQCommon.hidden = function (id) {
    id.css('display', 'none');
};

MQCommon.api();

/**
 * 对话框
 * @param id
 * @param title
 * @param content
 */
MQCommon.Dialog = {};

MQCommon.Dialog.init = function (icon, title, yTitle, nTitle, yFunc, nFunc) {
    //询问框
    layer.confirm(title, {
        icon: icon,
        btn: [yTitle, nTitle] //按钮
    }, yFunc, nFunc);
};

MQCommon.Dialog.alert = function (title, yFunc) {
    this.init(3, title, '是', '否', yFunc, function () {
        return;
    });
};

MQCommon.Dialog.alertUrl = function (title, url) {
    this.alert(title, function () {
        param = {};
        MQC.api(url, param, function (ret) {
            if (ret.code == 200) {
                layer.msg(ret.msg, {}, function () {
                    window.location.reload();
                });
            } else {
                layer.msg(ret.msg);
            }
        }, function (ret) {
            layer.msg('系统错误');
        });
        return;
    }, function () {
        return;
    });
};

MQCommon.Dialog.save = function (dlg, btnSave, url, arrParam) {

    $('#' + btnSave).click(function (e) {
        param = {};
        $.each(arrParam, function (idx, val) {
            param[val] = $('#' + val).val();
        });
        MQC.api(url, param, function (ret) {
            if (ret.code == 200) {
                layer.msg(ret.msg, {}, function () {
                    $('#' + dlg).modal('hide');
                    window.location.reload();
                });
            } else {
                layer.msg(ret.msg);
            }
        }, function (ret) {
            layer.msg('系统错误');
        });
    });
}

MQCommon.Dialog.data = function (url, arrParam) {
    param = {};

    MQC.api(url, param, function (ret) {
        if (ret.code == 200) {
            $.each(arrParam, function (idx, val) {
                console.log(ret.data[val]);
                $('#' + val).val(ret.data[val]);
            });
        }
    }, function (ret) {
        layer.msg('系统错误');
    });
}

MQCommon.Selector = {};

MQCommon.Selector.setCurrID = function (id, val) {
    $('#' + id).val(val);
}