// Generated by CoffeeScript 1.4.0
(function() {
  var __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

  (function(root, factory) {
    if (typeof define === 'function' && define.amd) {
      return define(['elgg', 'jquery', 'handlebars', 'crop', 'foowdFormCheck', 'foowd_utenti/gallery-crop-lightbox', 'foowd_utenti/file'], factory);
    } else if (typeof exports === 'object') {
      return module.exports = factory();
    } else {
      return root.returnExports = factory();
    }
  })(this, function() {
    var $, Jform, Jgenre, Jhook, JmailLabel, ajaxCheck, ar, crop, elgg, fct, file, flds, form, needAr, noNeedAr, setNeed, va, _i, _len;
    console.log("test");
    elgg = require('elgg');
    $ = require('jquery');
    crop = require('foowd_utenti/gallery-crop-lightbox');
    form = require('foowdFormCheck');
    Jhook = $('#offer-hook');
    Jform = Jhook.parents('form:first');
    Jgenre = $('[name=Genre]');
    Jform.attr('enctype', 'multipart/form-data');
    Jhook.css({
      display: 'none'
    });
    Jgenre.val('standard');
    file = require('foowd_utenti/file');
    crop.create().initialize(file.fileCropInit());
    $(document).on("foowd:update:file", function(e, mydata) {
      crop.create().initialize(file.fileCropInit());
    });
    fct = form.factory();
    ar = [];
    flds = ['email', 'username', 'name', 'password'];
    for (_i = 0, _len = flds.length; _i < _len; _i++) {
      va = flds[_i];
      JmailLabel = $('[name="' + va + '"]').prevUntil('', 'label');
      JmailLabel.attr({
        'for': va
      });
    }
    ajaxCheck = function() {
      var url, v,
        _this = this;
      v = this.el.val().trim();
      url = elgg.get_site_url() + 'foowd_utility/user-check?' + this.key + '=' + v;
      console.log(v);
      return elgg.get(url, {
        success: function(resultText, success, xhr) {
          var obj, ret;
          obj = JSON.parse(resultText);
          if (typeof obj === 'object') {
            ret = obj[_this.key];
          } else {
            ret = false;
          }
          if (ret) {
            _this.error('Qesto valore e\' gia\' utilizzato. Prova con un altro');
            ret = false;
          } else {
            ret = true;
          }
          return _this.status = ret;
        }
      });
    };
    ar.push({
      cls: 'Email',
      obj: {
        inpt: 'form.elgg-form-register [name="email"]',
        key: 'email',
        el: 'form.elgg-form-register [name="email"]',
        msg: 'foowd:user:email:error',
        'afterCheck': ajaxCheck
      }
    });
    ar.push({
      cls: 'Text',
      obj: {
        inpt: 'form.elgg-form-register [name="username"]',
        key: 'username',
        el: 'form.elgg-form-register [name="username"]',
        msg: 'foowd:user:username:error',
        'afterCheck': ajaxCheck
      }
    });
    ar.push({
      cls: 'Phone',
      obj: {
        inpt: 'form.elgg-form-register [name="Phone"]',
        key: 'Phone',
        el: 'form.elgg-form-register [name="Phone"]',
        msg: 'foowd:user:phone:error'
      }
    });
    ar.push({
      cls: 'WebDomain',
      obj: {
        inpt: 'form.elgg-form-register [name="Site"]',
        key: 'Site',
        el: 'form.elgg-form-register [name="Site"]',
        msg: 'foowd:user:site:error'
      }
    });
    ar.push({
      cls: 'Piva',
      obj: {
        inpt: 'form.elgg-form-register [name="Piva"]',
        key: 'Piva',
        el: 'form.elgg-form-register [name="Piva"]',
        msg: 'foowd:user:piva:error'
      }
    });
    ar.push({
      cls: 'Text',
      obj: {
        inpt: 'form.elgg-form-register [name="Address"]',
        key: 'Address',
        el: 'form.elgg-form-register [name="Address"]',
        msg: 'foowd:user:address:error'
      }
    });
    ar.push({
      cls: 'Text',
      obj: {
        inpt: 'form.elgg-form-register [name="Company"]',
        key: 'Company',
        el: 'form.elgg-form-register [name="Company"]',
        msg: 'foowd:user:company:error'
      }
    });
    fct.pushFromArray(ar);
    needAr = ['email', 'username', 'name'];
    noNeedAr = ['Site'];
    setNeed = function(bool) {
      return fct.each(function() {
        var _ref, _ref1;
        if ((_ref = this.key, __indexOf.call(needAr, _ref) >= 0)) {
          this.needle = true;
        } else if ((_ref1 = this.key, __indexOf.call(noNeedAr, _ref1) >= 0)) {
          this.needle = false;
        } else {
          this.needle = bool;
        }
      });
    };
    setNeed(false);
    $('.mtm').css({
      'display': 'none'
    });
    form.submit('form.elgg-form-register', function() {
      var Jname, pwd, pwd2;
      Jname = $('form.elgg-form-register [name="name"]').val($('form.elgg-form-register [name="username"]').val());
      if (Jgenre.val() === 'offerente') {
        if (!file.atLeastOne()) {
          alert("Devi inserire almeno un'immagine");
        }
      }
      pwd = $('form.elgg-form-register [name="password"]').val();
      pwd2 = $('form.elgg-form-register [name="password2"]').val();
      if (pwd.length <= 5) {
        alert("La password deve contentere almeno 6 caratteri");
        return false;
      }
      if (pwd !== pwd2) {
        alert("Attenzione, le password non combaciano");
        return false;
      }
      return true;
    });
    return Jgenre.on("change", function() {
      if ($(this).val() === 'offerente') {
        Jhook.fadeIn('slow');
        return setNeed(true);
      } else {
        Jhook.fadeOut('slow');
        setNeed(false);
        return $('#offer-hook').find('[type="text"]').each(function() {
          return $(this).val('');
        });
      }
    });
  });

}).call(this);
