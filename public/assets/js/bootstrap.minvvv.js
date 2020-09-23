/*!
 * jQuery formBuilder: https://formbuilder.online/
 * Version: 3.2.5
 * Author: Kevin Chappell <kevin.b.chappell@gmail.com>
 */
! function(e) {
  "use strict";
  ! function(e) {
      var t = {};

      function r(n) {
          if (t[n]) return t[n].exports;
          var o = t[n] = {
              i: n,
              l: !1,
              exports: {}
          };
          return e[n].call(o.exports, o, o.exports, r), o.l = !0, o.exports
      }
      r.m = e, r.c = t, r.d = function(e, t, n) {
          r.o(e, t) || Object.defineProperty(e, t, {
              enumerable: !0,
              get: n
          })
      }, r.r = function(e) {
          "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
              value: "Module"
          }), Object.defineProperty(e, "__esModule", {
              value: !0
          })
      }, r.t = function(e, t) {
          if (1 & t && (e = r(e)), 8 & t) return e;
          if (4 & t && "object" == typeof e && e && e.__esModule) return e;
          var n = Object.create(null);
          if (r.r(n), Object.defineProperty(n, "default", {
                  enumerable: !0,
                  value: e
              }), 2 & t && "string" != typeof e)
              for (var o in e) r.d(n, o, function(t) {
                  return e[t]
              }.bind(null, o));
          return n
      }, r.n = function(e) {
          var t = e && e.__esModule ? function() {
              return e.default
          } : function() {
              return e
          };
          return r.d(t, "a", t), t
      }, r.o = function(e, t) {
          return Object.prototype.hasOwnProperty.call(e, t)
      }, r.p = "", r(r.s = 33)
  }([function(t, r, n) {
      function o(e) {
          for (var t = 1; t < arguments.length; t++) {
              var r = null != arguments[t] ? arguments[t] : {},
                  n = Object.keys(r);
              "function" == typeof Object.getOwnPropertySymbols && (n = n.concat(Object.getOwnPropertySymbols(r).filter(function(e) {
                  return Object.getOwnPropertyDescriptor(r, e).enumerable
              }))), n.forEach(function(t) {
                  i(e, t, r[t])
              })
          }
          return e
      }

      function i(e, t, r) {
          return t in e ? Object.defineProperty(e, t, {
              value: r,
              enumerable: !0,
              configurable: !0,
              writable: !0
          }) : e[t] = r, e
      }

      function a(e, t) {
          if (null == e) return {};
          var r, n, o = {},
              i = Object.keys(e);
          for (n = 0; n < i.length; n++) r = i[n], t.indexOf(r) >= 0 || (o[r] = e[r]);
          return o
      }
      n.d(r, "y", function() {
          return l
      }), n.d(r, "A", function() {
          return u
      }), n.d(r, "b", function() {
          return f
      }), n.d(r, "h", function() {
          return d
      }), n.d(r, "m", function() {
          return m
      }), n.d(r, "c", function() {
          return b
      }), n.d(r, "r", function() {
          return h
      }), n.d(r, "p", function() {
          return v
      }), n.d(r, "s", function() {
          return x
      }), n.d(r, "t", function() {
          return A
      }), n.d(r, "g", function() {
          return O
      }), n.d(r, "i", function() {
          return j
      }), n.d(r, "z", function() {
          return q
      }), n.d(r, "u", function() {
          return C
      }), n.d(r, "k", function() {
          return E
      }), n.d(r, "o", function() {
          return L
      }), n.d(r, "l", function() {
          return N
      }), n.d(r, "d", function() {
          return S
      }), n.d(r, "a", function() {
          return T
      }), n.d(r, "e", function() {
          return D
      }), n.d(r, "q", function() {
          return B
      }), n.d(r, "w", function() {
          return R
      }), n.d(r, "j", function() {
          return F
      }), n.d(r, "x", function() {
          return M
      }), n.d(r, "n", function() {
          return I
      }), n.d(r, "v", function() {
          return z
      }), window.fbLoaded = {
          js: [],
          css: []
      }, window.fbEditors = {
          quill: {},
          tinymce: {}
      };
      var l = function(e) {
              var t = [null, void 0, "", !1, "false"];
              for (var r in e) t.includes(e[r]) ? delete e[r] : Array.isArray(e[r]) && (e[r].length || delete e[r]);
              return e
          },
          s = function(e) {
              return !["values", "enableOther", "other", "label", "subtype"].includes(e)
          },
          u = function(e) {
              return Object.entries(e).map(function(e) {
                  var t = e[0],
                      r = e[1];
                  return m(t) + '="' + r + '"'
              }).join(" ")
          },
          f = function(e) {
              return Object.entries(e).map(function(e) {
                  var t = e[0],
                      r = e[1];
                  return s(t) && Object.values(c(t, r)).join("")
              }).filter(Boolean).join(" ")
          },
          c = function(e, t) {
              var r;
              return e = p(e), t && (Array.isArray(t) ? r = k(t.join(" ")) : ("boolean" == typeof t && (t = t.toString()), r = k(t.trim()))), {
                  name: e,
                  value: t = t ? '="' + r + '"' : ""
              }
          },
          d = function e(t) {
              return t.reduce(function(t, r) {
                  return t.concat(Array.isArray(r) ? e(r) : r)
              }, [])
          },
          p = function(e) {
              return {
                  className: "class"
              }[e] || m(e)
          },
          m = function(e) {
              return (e = (e = e.replace(/[^\w\s\-]/gi, "")).replace(/([A-Z])/g, function(e) {
                  return "-" + e.toLowerCase()
              })).replace(/\s/g, "-").replace(/^-+/g, "")
          },
          b = function(e) {
              return e.replace(/-([a-z])/g, function(e, t) {
                  return t.toUpperCase()
              })
          },
          h = function(e) {
              var t = (new Date).getTime();
              return (e.type || m(e.label)) + "-" + t
          },
          g = function(e) {
              return void 0 === e ? e : [
                  ["array", function(e) {
                      return Array.isArray(e)
                  }],
                  ["node", function(e) {
                      return e instanceof window.Node || e instanceof window.HTMLElement
                  }],
                  ["component", function() {
                      return e && e.dom
                  }],
                  [typeof e, function() {
                      return !0
                  }]
              ].find(function(t) {
                  return t[1](e)
              })[0]
          },
          v = function e(t, r, n) {
              void 0 === r && (r = ""), void 0 === n && (n = {});
              var o = g(r),
                  i = n,
                  l = i.events,
                  s = a(i, ["events"]),
                  u = document.createElement(t),
                  f = {
                      string: function(e) {
                          u.innerHTML += e
                      },
                      object: function(t) {
                          var r = t.tag,
                              n = t.content,
                              o = a(t, ["tag", "content"]);
                          return u.appendChild(e(r, n, o))
                      },
                      node: function(e) {
                          return u.appendChild(e)
                      },
                      array: function(e) {
                          for (var t = 0; t < e.length; t++) o = g(e[t]), f[o](e[t])
                      },
                      function: function(e) {
                          e = e(), o = g(e), f[o](e)
                      },
                      undefined: function() {}
                  };
              for (var c in s)
                  if (s.hasOwnProperty(c)) {
                      var d = p(c),
                          m = Array.isArray(s[c]) ? q(s[c].join(" ").split(" ")).join(" ") : s[c];
                      u.setAttribute(d, m)
                  }
              return r && f[o](r),
                  function(e, t) {
                      if (t) {
                          var r = function(r) {
                              t.hasOwnProperty(r) && e.addEventListener(r, function(e) {
                                  return t[r](e)
                              })
                          };
                          for (var n in t) r(n)
                      }
                  }(u, l), u
          },
          y = function(e) {
              var t = e.attributes,
                  r = {};
              return j(t, function(e) {
                  var n = t[e].value || "";
                  n.match(/false|true/g) ? n = "true" === n : n.match(/undefined/g) && (n = void 0), n && (r[b(t[e].name)] = n)
              }), r
          },
          w = function(e) {
              for (var t = [], r = 0; r < e.length; r++) {
                  var n = o({}, y(e[r]), {
                      label: e[r].textContent
                  });
                  t.push(n)
              }
              return t
          },
          x = function(e) {
              var t = (new window.DOMParser).parseFromString(e, "text/xml"),
                  r = [];
              if (t)
                  for (var n = t.getElementsByTagName("field"), o = 0; o < n.length; o++) {
                      var i = y(n[o]),
                          a = n[o].getElementsByTagName("option");
                      a && a.length && (i.values = w(a)), r.push(i)
                  }
              return r
          },
          A = function(e) {
              var t = document.createElement("textarea");
              return t.innerHTML = e, t.textContent
          },
          O = function(e) {
              var t = document.createElement("textarea");
              return t.textContent = e, t.innerHTML
          },
          k = function(e) {
              var t = {
                  '"': "&quot;",
                  "&": "&amp;",
                  "<": "&lt;",
                  ">": "&gt;"
              };
              return "string" == typeof e ? e.replace(/["&<>]/g, function(e) {
                  return t[e] || e
              }) : e
          },
          j = function(e, t, r) {
              for (var n = 0; n < e.length; n++) t.call(r, n, e[n])
          },
          q = function(e) {
              return e.filter(function(e, t, r) {
                  return r.indexOf(e) === t
              })
          },
          C = function(e, t) {
              var r = t.indexOf(e);
              r > -1 && t.splice(r, 1)
          },
          E = function(e, t) {
              var r, n = jQuery,
                  o = [];
              return Array.isArray(e) || (e = [e]), L(e) || (o = jQuery.map(e, function(e) {
                  var r = {
                      dataType: "script",
                      cache: !0,
                      url: (t || "") + e
                  };
                  return jQuery.ajax(r).done(function() {
                      return window.fbLoaded.js.push(e)
                  })
              })), o.push(jQuery.Deferred(function(e) {
                  return n(e.resolve)
              })), (r = jQuery).when.apply(r, o)
          },
          L = function(e, t) {
              void 0 === t && (t = "js");
              var r = !1,
                  n = window.fbLoaded[t];
              return r = Array.isArray(e) ? e.every(function(e) {
                  return n.includes(e)
              }) : n.includes(e), r
          },
          N = function(t, r) {
              Array.isArray(t) || (t = [t]), t.forEach(function(t) {
                  var n = "href",
                      o = t,
                      i = "";
                  if ("object" == typeof t && (n = t.type || (t.style ? "inline" : "href"), i = t.id, t = "inline" == n ? t.style : t.href, o = i || t.href || t.style), !L(o, "css")) {
                      if ("href" == n) {
                          var a = document.createElement("link");
                          a.type = "text/css", a.rel = "stylesheet", a.href = (r || "") + t, document.head.appendChild(a)
                      } else e('<style type="text/css">' + t + "</style>").attr("id", i).appendTo(e(document.head));
                      window.fbLoaded.css.push(o)
                  }
              })
          },
          S = function(e) {
              return e.replace(/\b\w/g, function(e) {
                  return e.toUpperCase()
              })
          },
          T = function(e, t, r) {
              return t.split(" ").forEach(function(t) {
                  return e.addEventListener(t, r, !1)
              })
          },
          D = function(e, t) {
              for (var r = t.replace(".", "");
                  (e = e.parentElement) && !e.classList.contains(r););
              return e
          },
          B = function() {
              var e, t = "";
              return e = navigator.userAgent || navigator.vendor || window.opera, /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(e) && (t = "fb-mobile"), t
          },
          R = function(e) {
              return e.replace(/\s/g, "-").replace(/[^a-zA-Z0-9[\]_-]/g, "")
          },
          F = function(e) {
              return e.replace(/[^0-9]/g, "")
          },
          M = function(e, t) {
              return t.filter(function(e) {
                  return !~this.indexOf(e)
              }, e)
          },
          I = function(e) {
              var t = (e = Array.isArray(e) ? e : [e]).map(function(e) {
                  var t = e.src,
                      r = e.id;
                  return new Promise(function(e, n) {
                      if (window.fbLoaded.css.includes(t)) return e(t);
                      var o = v("link", null, {
                          href: t,
                          rel: "stylesheet",
                          id: r
                      });
                      document.head.insertBefore(o, document.head.firstChild)
                  })
              });
              return Promise.all(t)
          },
          z = function(e) {
              var t = document.getElementById(e);
              return t.parentElement.removeChild(t)
          },
          P = {
              addEventListeners: T,
              attrString: f,
              camelCase: b,
              capitalize: S,
              closest: D,
              getContentType: g,
              escapeAttr: k,
              escapeAttrs: function(e) {
                  for (var t in e) e.hasOwnProperty(t) && (e[t] = k(e[t]));
                  return e
              },
              escapeHtml: O,
              forceNumber: F,
              forEach: j,
              getScripts: E,
              getStyles: N,
              hyphenCase: m,
              isCached: L,
              markup: v,
              merge: function e(t, r) {
                  var n = Object.assign({}, t, r);
                  for (var o in r) n.hasOwnProperty(o) && (Array.isArray(r[o]) ? n[o] = Array.isArray(t[o]) ? q(t[o].concat(r[o])) : r[o] : "object" == typeof r[o] ? n[o] = e(t[o], r[o]) : n[o] = r[o]);
                  return n
              },
              mobileClass: B,
              nameAttr: h,
              parseAttrs: y,
              parsedHtml: A,
              parseOptions: w,
              parseXML: x,
              removeFromArray: C,
              safeAttr: c,
              safeAttrName: p,
              safename: R,
              subtract: M,
              trimObj: l,
              unique: q,
              validAttr: s,
              splitObject: function(e, t) {
                  var r = function(e) {
                      return function(t, r) {
                          return t[r] = e[r], t
                      }
                  };
                  return [Object.keys(e).filter(function(e) {
                      return t.includes(e)
                  }).reduce(r(e), {}), Object.keys(e).filter(function(e) {
                      return !t.includes(e)
                  }).reduce(r(e), {})]
              }
          };
      r.f = P
  }, function(e, t, r) {
      r.d(t, "a", function() {
          return l
      });
      var n = r(0),
          o = r(2),
          i = r.n(o);

      function a(e, t) {
          for (var r = 0; r < t.length; r++) {
              var n = t[r];
              n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
          }
      }
      var l = function() {
          function e(t, r) {
              this.rawConfig = jQuery.extend({}, t), t = jQuery.extend({}, t), this.preview = r, delete t.isPreview, this.preview && delete t.required;
              for (var n = 0, o = ["label", "description", "subtype", "required", "disabled"]; n < o.length; n++) {
                  var i = o[n];
                  this[i] = t[i], delete t[i]
              }
              t.id || (t.name ? t.id = t.name : t.id = "control-" + Math.floor(1e7 * Math.random() + 1)), this.id = t.id, this.type = t.type, this.description && (t.title = this.description), e.controlConfig || (e.controlConfig = {});
              var a = this.subtype ? this.type + "." + this.subtype : this.type;
              this.classConfig = jQuery.extend({}, e.controlConfig[a] || {}), this.subtype && (t.type = this.subtype), this.required && (t.required = "required", t["aria-required"] = "true"), this.disabled && (t.disabled = "disabled"), this.config = t, this.configure()
          }
          e.register = function(t, r, n) {
              var o = n ? n + "." : "";
              e.classRegister || (e.classRegister = {}), Array.isArray(t) || (t = [t]);
              var i = t,
                  a = Array.isArray(i),
                  l = 0;
              for (i = a ? i : i[Symbol.iterator]();;) {
                  var s;
                  if (a) {
                      if (l >= i.length) break;
                      s = i[l++]
                  } else {
                      if ((l = i.next()).done) break;
                      s = l.value
                  }
                  var u = s; - 1 === u.indexOf(".") ? e.classRegister[o + u] = r : e.error("Ignoring type " + u + ". Cannot use the character '.' in a type name.")
              }
          }, e.getRegistered = function(t) {
              void 0 === t && (t = !1);
              var r = Object.keys(e.classRegister);
              return r.length ? r.filter(function(e) {
                  return t ? e.indexOf(t + ".") > -1 : -1 == e.indexOf(".")
              }) : r
          }, e.getRegisteredSubtypes = function() {
              var t = {};
              for (var r in e.classRegister)
                  if (e.classRegister.hasOwnProperty(r)) {
                      var n = r.split("."),
                          o = n[0],
                          i = n[1];
                      if (!i) continue;
                      t[o] || (t[o] = []), t[o].push(i)
                  }
              return t
          }, e.getClass = function(t, r) {
              var n = r ? t + "." + r : t,
                  o = e.classRegister[n] || e.classRegister[t];
              return o || e.error("Invalid control type. (Type: " + t + ", Subtype: " + r + "). Please ensure you have registered it, and imported it correctly.")
          }, e.loadCustom = function(t) {
              var r = [];
              if (t && (r = r.concat(t)), window.fbControls && (r = r.concat(window.fbControls)), !this.fbControlsLoaded) {
                  var n = r,
                      o = Array.isArray(n),
                      i = 0;
                  for (n = o ? n : n[Symbol.iterator]();;) {
                      var a;
                      if (o) {
                          if (i >= n.length) break;
                          a = n[i++]
                      } else {
                          if ((i = n.next()).done) break;
                          a = i.value
                      }
                      a(e, e.classRegister)
                  }
                  this.fbControlsLoaded = !0
              }
          }, e.mi18n = function(e, t) {
              var r = this.definition,
                  n = r.i18n || {};
              n = n[i.a.locale] || n.default || n;
              var o = this.camelCase(e),
                  a = "object" == typeof n ? n[o] || n[e] : n;
              if (a) return a;
              var l = r.mi18n;
              return "object" == typeof l && (l = l[o] || l[e]), l || (l = o), i.a.get(l, t)
          }, e.active = function(e) {
              return !Array.isArray(this.definition.inactive) || -1 == this.definition.inactive.indexOf(e)
          }, e.label = function(e) {
              return this.mi18n(e)
          }, e.icon = function(e) {
              var t = this.definition;
              return t && "object" == typeof t.icon ? t.icon[e] : t.icon
          };
          var t, r, o, l = e.prototype;
          return l.configure = function() {}, l.build = function() {
              var e = this.config,
                  t = e.label,
                  r = e.type,
                  o = function(e, t) {
                      if (null == e) return {};
                      var r, n, o = {},
                          i = Object.keys(e);
                      for (n = 0; n < i.length; n++) r = i[n], t.indexOf(r) >= 0 || (o[r] = e[r]);
                      return o
                  }(e, ["label", "type"]);
              return this.markup(r, Object(n.t)(t), o)
          }, l.on = function(e) {
              var t = this,
                  r = {
                      prerender: function(e) {},
                      render: function(e) {
                          var r = function() {
                              t.onRender && t.onRender()
                          };
                          t.css && Object(n.l)(t.css), t.js && !Object(n.o)(t.js) ? Object(n.k)(t.js).done(r) : r()
                      }
                  };
              return e ? r[e] : r
          }, e.error = function(e) {
              throw new Error(e)
          }, l.markup = function(e, t, r) {
              return void 0 === t && (t = ""), void 0 === r && (r = {}), this.element = Object(n.p)(e, t, r), this.element
          }, l.parsedHtml = function(e) {
              return Object(n.t)(e)
          }, e.camelCase = function(e) {
              return Object(n.c)(e)
          }, t = e, o = [{
              key: "definition",
              get: function() {
                  return {}
              }
          }], (r = null) && a(t.prototype, r), o && a(t, o), e
      }()
  }, function(e, t) {
      /*!
       * mi18n - https://github.com/Draggable/mi18n
       * Version: 0.4.7
       * Author: Kevin Chappell <kevin.b.chappell@gmail.com> (http://kevin-chappell.com)
       */
      e.exports = function(e) {
          var t = {};

          function r(n) {
              if (t[n]) return t[n].exports;
              var o = t[n] = {
                  i: n,
                  l: !1,
                  exports: {}
              };
              return e[n].call(o.exports, o, o.exports, r), o.l = !0, o.exports
          }
          return r.m = e, r.c = t, r.d = function(e, t, n) {
              r.o(e, t) || Object.defineProperty(e, t, {
                  enumerable: !0,
                  get: n
              })
          }, r.r = function(e) {
              "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
                  value: "Module"
              }), Object.defineProperty(e, "__esModule", {
                  value: !0
              })
          }, r.t = function(e, t) {
              if (1 & t && (e = r(e)), 8 & t) return e;
              if (4 & t && "object" == typeof e && e && e.__esModule) return e;
              var n = Object.create(null);
              if (r.r(n), Object.defineProperty(n, "default", {
                      enumerable: !0,
                      value: e
                  }), 2 & t && "string" != typeof e)
                  for (var o in e) r.d(n, o, function(t) {
                      return e[t]
                  }.bind(null, o));
              return n
          }, r.n = function(e) {
              var t = e && e.__esModule ? function() {
                  return e.default
              } : function() {
                  return e
              };
              return r.d(t, "a", t), t
          }, r.o = function(e, t) {
              return Object.prototype.hasOwnProperty.call(e, t)
          }, r.p = "", r(r.s = 7)
      }([function(e, t, r) {
          var n = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                  return typeof e
              } : function(e) {
                  return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
              },
              o = r(2),
              i = r(10),
              a = Object.prototype.toString;

          function l(e) {
              return "[object Array]" === a.call(e)
          }

          function s(e) {
              return null !== e && "object" === (void 0 === e ? "undefined" : n(e))
          }

          function u(e) {
              return "[object Function]" === a.call(e)
          }

          function f(e, t) {
              if (null != e)
                  if ("object" !== (void 0 === e ? "undefined" : n(e)) && (e = [e]), l(e))
                      for (var r = 0, o = e.length; r < o; r++) t.call(null, e[r], r, e);
                  else
                      for (var i in e) Object.prototype.hasOwnProperty.call(e, i) && t.call(null, e[i], i, e)
          }
          e.exports = {
              isArray: l,
              isArrayBuffer: function(e) {
                  return "[object ArrayBuffer]" === a.call(e)
              },
              isBuffer: i,
              isFormData: function(e) {
                  return "undefined" != typeof FormData && e instanceof FormData
              },
              isArrayBufferView: function(e) {
                  return "undefined" != typeof ArrayBuffer && ArrayBuffer.isView ? ArrayBuffer.isView(e) : e && e.buffer && e.buffer instanceof ArrayBuffer
              },
              isString: function(e) {
                  return "string" == typeof e
              },
              isNumber: function(e) {
                  return "number" == typeof e
              },
              isObject: s,
              isUndefined: function(e) {
                  return void 0 === e
              },
              isDate: function(e) {
                  return "[object Date]" === a.call(e)
              },
              isFile: function(e) {
                  return "[object File]" === a.call(e)
              },
              isBlob: function(e) {
                  return "[object Blob]" === a.call(e)
              },
              isFunction: u,
              isStream: function(e) {
                  return s(e) && u(e.pipe)
              },
              isURLSearchParams: function(e) {
                  return "undefined" != typeof URLSearchParams && e instanceof URLSearchParams
              },
              isStandardBrowserEnv: function() {
                  return ("undefined" == typeof navigator || "ReactNative" !== navigator.product) && "undefined" != typeof window && "undefined" != typeof document
              },
              forEach: f,
              merge: function e() {
                  var t = {};

                  function r(r, o) {
                      "object" === n(t[o]) && "object" === (void 0 === r ? "undefined" : n(r)) ? t[o] = e(t[o], r) : t[o] = r
                  }
                  for (var o = 0, i = arguments.length; o < i; o++) f(arguments[o], r);
                  return t
              },
              extend: function(e, t, r) {
                  return f(t, function(t, n) {
                      e[n] = r && "function" == typeof t ? o(t, r) : t
                  }), e
              },
              trim: function(e) {
                  return e.replace(/^\s*/, "").replace(/\s*$/, "")
              }
          }
      }, function(e, t, r) {
          (function(t) {
              var n = r(0),
                  o = r(13),
                  i = {
                      "Content-Type": "application/x-www-form-urlencoded"
                  };

              function a(e, t) {
                  !n.isUndefined(e) && n.isUndefined(e["Content-Type"]) && (e["Content-Type"] = t)
              }
              var l = {
                  adapter: function() {
                      var e;
                      return "undefined" != typeof XMLHttpRequest ? e = r(3) : void 0 !== t && (e = r(3)), e
                  }(),
                  transformRequest: [function(e, t) {
                      return o(t, "Content-Type"), n.isFormData(e) || n.isArrayBuffer(e) || n.isBuffer(e) || n.isStream(e) || n.isFile(e) || n.isBlob(e) ? e : n.isArrayBufferView(e) ? e.buffer : n.isURLSearchParams(e) ? (a(t, "application/x-www-form-urlencoded;charset=utf-8"), e.toString()) : n.isObject(e) ? (a(t, "application/json;charset=utf-8"), JSON.stringify(e)) : e
                  }],
                  transformResponse: [function(e) {
                      if ("string" == typeof e) try {
                          e = JSON.parse(e)
                      } catch (e) {}
                      return e
                  }],
                  timeout: 0,
                  xsrfCookieName: "XSRF-TOKEN",
                  xsrfHeaderName: "X-XSRF-TOKEN",
                  maxContentLength: -1,
                  validateStatus: function(e) {
                      return e >= 200 && e < 300
                  },
                  headers: {
                      common: {
                          Accept: "application/json, text/plain, */*"
                      }
                  }
              };
              n.forEach(["delete", "get", "head"], function(e) {
                  l.headers[e] = {}
              }), n.forEach(["post", "put", "patch"], function(e) {
                  l.headers[e] = n.merge(i)
              }), e.exports = l
          }).call(this, r(12))
      }, function(e, t, r) {
          e.exports = function(e, t) {
              return function() {
                  for (var r = new Array(arguments.length), n = 0; n < r.length; n++) r[n] = arguments[n];
                  return e.apply(t, r)
              }
          }
      }, function(e, t, r) {
          var n = r(0),
              o = r(14),
              i = r(16),
              a = r(17),
              l = r(18),
              s = r(4),
              u = "undefined" != typeof window && window.btoa && window.btoa.bind(window) || r(19);
          e.exports = function(e) {
              return new Promise(function(t, f) {
                  var c = e.data,
                      d = e.headers;
                  n.isFormData(c) && delete d["Content-Type"];
                  var p = new XMLHttpRequest,
                      m = "onreadystatechange",
                      b = !1;
                  if ("undefined" == typeof window || !window.XDomainRequest || "withCredentials" in p || l(e.url) || (p = new window.XDomainRequest, m = "onload", b = !0, p.onprogress = function() {}, p.ontimeout = function() {}), e.auth) {
                      var h = e.auth.username || "",
                          g = e.auth.password || "";
                      d.Authorization = "Basic " + u(h + ":" + g)
                  }
                  if (p.open(e.method.toUpperCase(), i(e.url, e.params, e.paramsSerializer), !0), p.timeout = e.timeout, p[m] = function() {
                          if (p && (4 === p.readyState || b) && (0 !== p.status || p.responseURL && 0 === p.responseURL.indexOf("file:"))) {
                              var r = "getAllResponseHeaders" in p ? a(p.getAllResponseHeaders()) : null,
                                  n = {
                                      data: e.responseType && "text" !== e.responseType ? p.response : p.responseText,
                                      status: 1223 === p.status ? 204 : p.status,
                                      statusText: 1223 === p.status ? "No Content" : p.statusText,
                                      headers: r,
                                      config: e,
                                      request: p
                                  };
                              o(t, f, n), p = null
                          }
                      }, p.onerror = function() {
                          f(s("Network Error", e, null, p)), p = null
                      }, p.ontimeout = function() {
                          f(s("timeout of " + e.timeout + "ms exceeded", e, "ECONNABORTED", p)), p = null
                      }, n.isStandardBrowserEnv()) {
                      var v = r(20),
                          y = (e.withCredentials || l(e.url)) && e.xsrfCookieName ? v.read(e.xsrfCookieName) : void 0;
                      y && (d[e.xsrfHeaderName] = y)
                  }
                  if ("setRequestHeader" in p && n.forEach(d, function(e, t) {
                          void 0 === c && "content-type" === t.toLowerCase() ? delete d[t] : p.setRequestHeader(t, e)
                      }), e.withCredentials && (p.withCredentials = !0), e.responseType) try {
                      p.responseType = e.responseType
                  } catch (t) {
                      if ("json" !== e.responseType) throw t
                  }
                  "function" == typeof e.onDownloadProgress && p.addEventListener("progress", e.onDownloadProgress), "function" == typeof e.onUploadProgress && p.upload && p.upload.addEventListener("progress", e.onUploadProgress), e.cancelToken && e.cancelToken.promise.then(function(e) {
                      p && (p.abort(), f(e), p = null)
                  }), void 0 === c && (c = null), p.send(c)
              })
          }
      }, function(e, t, r) {
          var n = r(15);
          e.exports = function(e, t, r, o, i) {
              var a = new Error(e);
              return n(a, t, r, o, i)
          }
      }, function(e, t, r) {
          e.exports = function(e) {
              return !(!e || !e.__CANCEL__)
          }
      }, function(e, t, r) {
          function n(e) {
              this.message = e
          }
          n.prototype.toString = function() {
              return "Cancel" + (this.message ? ": " + this.message : "")
          }, n.prototype.__CANCEL__ = !0, e.exports = n
      }, function(e, t, r) {
          t.__esModule = !0, t.I18N = void 0;
          var n = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                  return typeof e
              } : function(e) {
                  return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
              },
              o = function() {
                  function e(e, t) {
                      for (var r = 0; r < t.length; r++) {
                          var n = t[r];
                          n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
                      }
                  }
                  return function(t, r, n) {
                      return r && e(t.prototype, r), n && e(t, n), t
                  }
              }(),
              i = r(8),
              a = {
                  extension: ".lang",
                  location: "assets/lang/",
                  langs: ["en-US"],
                  locale: "en-US",
                  override: {}
              },
              l = t.I18N = function() {
                  function e() {
                      var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : a;
                      ! function(e, t) {
                          if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                      }(this, e), this.langs = Object.create(null), this.loaded = [], this.processConfig(t)
                  }
                  return e.prototype.processConfig = function(e) {
                      var t = this,
                          r = Object.assign({}, a, e),
                          n = r.location,
                          o = function(e, t) {
                              var r = {};
                              for (var n in e) t.indexOf(n) >= 0 || Object.prototype.hasOwnProperty.call(e, n) && (r[n] = e[n]);
                              return r
                          }(r, ["location"]),
                          i = n.replace(/\/?$/, "/");
                      this.config = Object.assign({}, {
                          location: i
                      }, o);
                      var l = this.config,
                          s = l.override,
                          u = l.preloaded,
                          f = void 0 === u ? {} : u,
                          c = Object.entries(this.langs).concat(Object.entries(s || f));
                      this.langs = c.reduce(function(e, r) {
                          var n = r[0],
                              o = r[1];
                          return e[n] = t.applyLanguage.call(t, n, o), e
                      }, {}), this.locale = this.config.locale || this.config.langs[0]
                  }, e.prototype.init = function(e) {
                      return this.processConfig.call(this, Object.assign({}, this.config, e)), this.setCurrent(this.locale)
                  }, e.prototype.addLanguage = function(e) {
                      var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                      t = "string" == typeof t ? this.processFile.call(this, t) : t, this.applyLanguage.call(this, e, t), this.config.langs.push("locale")
                  }, e.prototype.getValue = function(e) {
                      var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.locale;
                      return this.langs[t] && this.langs[t][e] || this.getFallbackValue(e)
                  }, e.prototype.getFallbackValue = function(e) {
                      var t = Object.values(this.langs).find(function(t) {
                          return t[e]
                      });
                      return t && t[e]
                  }, e.prototype.makeSafe = function(e) {
                      var t = {
                          "{": "\\{",
                          "}": "\\}",
                          "|": "\\|"
                      };
                      return e = e.replace(/\{|\}|\|/g, function(e) {
                          return t[e]
                      }), new RegExp(e, "g")
                  }, e.prototype.put = function(e, t) {
                      return this.current[e] = t
                  }, e.prototype.get = function(e, t) {
                      var r = this.getValue(e);
                      if (r) {
                          var o = r.match(/\{[^}]+?\}/g),
                              i = void 0;
                          if (t && o)
                              if ("object" === (void 0 === t ? "undefined" : n(t)))
                                  for (var a = 0; a < o.length; a++) i = o[a].substring(1, o[a].length - 1), r = r.replace(this.makeSafe(o[a]), t[i] || "");
                              else r = r.replace(/\{[^}]+?\}/g, t);
                          return r
                      }
                  }, e.prototype.fromFile = function(e) {
                      for (var t, r = e.split("\n"), n = {}, o = 0; o < r.length; o++)(t = r[o].match(/^(.+?) *?= *?([^\n]+)/)) && (n[t[1]] = t[2].replace(/^\s+|\s+$/, ""));
                      return n
                  }, e.prototype.processFile = function(e) {
                      return this.fromFile(e.replace(/\n\n/g, "\n"))
                  }, e.prototype.loadLang = function(e) {
                      var t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1],
                          r = this;
                      return new Promise(function(n, o) {
                          if (-1 !== r.loaded.indexOf(e) && t) return r.applyLanguage.call(r, r.langs[e]), n(r.langs[e]);
                          var a = [r.config.location, e, r.config.extension].join("");
                          return (0, i.get)(a).then(function(t) {
                              var o = t.data,
                                  i = r.processFile(o);
                              return r.applyLanguage.call(r, e, i), r.loaded.push(e), n(r.langs[e])
                          }).catch(function() {
                              var t = r.applyLanguage.call(r, e);
                              n(t)
                          })
                      })
                  }, e.prototype.applyLanguage = function(e) {
                      var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                          r = this.config.override[e] || {},
                          n = this.langs[e] || {};
                      return this.langs[e] = Object.assign({}, n, t, r), this.langs[e]
                  }, e.prototype.setCurrent = function() {
                      var e = this,
                          t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "en-US";
                      return this.loadLang(t).then(function() {
                          return e.locale = t, e.current = e.langs[t], e.current
                      })
                  }, o(e, [{
                      key: "getLangs",
                      get: function() {
                          return this.config.langs
                      }
                  }]), e
              }();
          t.default = new l
      }, function(e, t, r) {
          e.exports = r(9)
      }, function(e, t, r) {
          var n = r(0),
              o = r(2),
              i = r(11),
              a = r(1);

          function l(e) {
              var t = new i(e),
                  r = o(i.prototype.request, t);
              return n.extend(r, i.prototype, t), n.extend(r, t), r
          }
          var s = l(a);
          s.Axios = i, s.create = function(e) {
              return l(n.merge(a, e))
          }, s.Cancel = r(6), s.CancelToken = r(26), s.isCancel = r(5), s.all = function(e) {
              return Promise.all(e)
          }, s.spread = r(27), e.exports = s, e.exports.default = s
      }, function(e, t, r) {
          /*!
           * Determine if an object is a Buffer
           *
           * @author   Feross Aboukhadijeh <https://feross.org>
           * @license  MIT
           */
          function n(e) {
              return !!e.constructor && "function" == typeof e.constructor.isBuffer && e.constructor.isBuffer(e)
          }
          e.exports = function(e) {
              return null != e && (n(e) || function(e) {
                  return "function" == typeof e.readFloatLE && "function" == typeof e.slice && n(e.slice(0, 0))
              }(e) || !!e._isBuffer)
          }
      }, function(e, t, r) {
          var n = r(1),
              o = r(0),
              i = r(21),
              a = r(22);

          function l(e) {
              this.defaults = e, this.interceptors = {
                  request: new i,
                  response: new i
              }
          }
          l.prototype.request = function(e) {
              "string" == typeof e && (e = o.merge({
                  url: arguments[0]
              }, arguments[1])), (e = o.merge(n, {
                  method: "get"
              }, this.defaults, e)).method = e.method.toLowerCase();
              var t = [a, void 0],
                  r = Promise.resolve(e);
              for (this.interceptors.request.forEach(function(e) {
                      t.unshift(e.fulfilled, e.rejected)
                  }), this.interceptors.response.forEach(function(e) {
                      t.push(e.fulfilled, e.rejected)
                  }); t.length;) r = r.then(t.shift(), t.shift());
              return r
          }, o.forEach(["delete", "get", "head", "options"], function(e) {
              l.prototype[e] = function(t, r) {
                  return this.request(o.merge(r || {}, {
                      method: e,
                      url: t
                  }))
              }
          }), o.forEach(["post", "put", "patch"], function(e) {
              l.prototype[e] = function(t, r, n) {
                  return this.request(o.merge(n || {}, {
                      method: e,
                      url: t,
                      data: r
                  }))
              }
          }), e.exports = l
      }, function(e, t, r) {
          var n, o, i = e.exports = {};

          function a() {
              throw new Error("setTimeout has not been defined")
          }

          function l() {
              throw new Error("clearTimeout has not been defined")
          }

          function s(e) {
              if (n === setTimeout) return setTimeout(e, 0);
              if ((n === a || !n) && setTimeout) return n = setTimeout, setTimeout(e, 0);
              try {
                  return n(e, 0)
              } catch (t) {
                  try {
                      return n.call(null, e, 0)
                  } catch (t) {
                      return n.call(this, e, 0)
                  }
              }
          }! function() {
              try {
                  n = "function" == typeof setTimeout ? setTimeout : a
              } catch (e) {
                  n = a
              }
              try {
                  o = "function" == typeof clearTimeout ? clearTimeout : l
              } catch (e) {
                  o = l
              }
          }();
          var u, f = [],
              c = !1,
              d = -1;

          function p() {
              c && u && (c = !1, u.length ? f = u.concat(f) : d = -1, f.length && m())
          }

          function m() {
              if (!c) {
                  var e = s(p);
                  c = !0;
                  for (var t = f.length; t;) {
                      for (u = f, f = []; ++d < t;) u && u[d].run();
                      d = -1, t = f.length
                  }
                  u = null, c = !1,
                      function(e) {
                          if (o === clearTimeout) return clearTimeout(e);
                          if ((o === l || !o) && clearTimeout) return o = clearTimeout, clearTimeout(e);
                          try {
                              o(e)
                          } catch (t) {
                              try {
                                  return o.call(null, e)
                              } catch (t) {
                                  return o.call(this, e)
                              }
                          }
                      }(e)
              }
          }

          function b(e, t) {
              this.fun = e, this.array = t
          }

          function h() {}
          i.nextTick = function(e) {
              var t = new Array(arguments.length - 1);
              if (arguments.length > 1)
                  for (var r = 1; r < arguments.length; r++) t[r - 1] = arguments[r];
              f.push(new b(e, t)), 1 !== f.length || c || s(m)
          }, b.prototype.run = function() {
              this.fun.apply(null, this.array)
          }, i.title = "browser", i.browser = !0, i.env = {}, i.argv = [], i.version = "", i.versions = {}, i.on = h, i.addListener = h, i.once = h, i.off = h, i.removeListener = h, i.removeAllListeners = h, i.emit = h, i.prependListener = h, i.prependOnceListener = h, i.listeners = function(e) {
              return []
          }, i.binding = function(e) {
              throw new Error("process.binding is not supported")
          }, i.cwd = function() {
              return "/"
          }, i.chdir = function(e) {
              throw new Error("process.chdir is not supported")
          }, i.umask = function() {
              return 0
          }
      }, function(e, t, r) {
          var n = r(0);
          e.exports = function(e, t) {
              n.forEach(e, function(r, n) {
                  n !== t && n.toUpperCase() === t.toUpperCase() && (e[t] = r, delete e[n])
              })
          }
      }, function(e, t, r) {
          var n = r(4);
          e.exports = function(e, t, r) {
              var o = r.config.validateStatus;
              r.status && o && !o(r.status) ? t(n("Request failed with status code " + r.status, r.config, null, r.request, r)) : e(r)
          }
      }, function(e, t, r) {
          e.exports = function(e, t, r, n, o) {
              return e.config = t, r && (e.code = r), e.request = n, e.response = o, e
          }
      }, function(e, t, r) {
          var n = r(0);

          function o(e) {
              return encodeURIComponent(e).replace(/%40/gi, "@").replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%20/g, "+").replace(/%5B/gi, "[").replace(/%5D/gi, "]")
          }
          e.exports = function(e, t, r) {
              if (!t) return e;
              var i;
              if (r) i = r(t);
              else if (n.isURLSearchParams(t)) i = t.toString();
              else {
                  var a = [];
                  n.forEach(t, function(e, t) {
                      null != e && (n.isArray(e) ? t += "[]" : e = [e], n.forEach(e, function(e) {
                          n.isDate(e) ? e = e.toISOString() : n.isObject(e) && (e = JSON.stringify(e)), a.push(o(t) + "=" + o(e))
                      }))
                  }), i = a.join("&")
              }
              return i && (e += (-1 === e.indexOf("?") ? "?" : "&") + i), e
          }
      }, function(e, t, r) {
          var n = r(0),
              o = ["age", "authorization", "content-length", "content-type", "etag", "expires", "from", "host", "if-modified-since", "if-unmodified-since", "last-modified", "location", "max-forwards", "proxy-authorization", "referer", "retry-after", "user-agent"];
          e.exports = function(e) {
              var t, r, i, a = {};
              return e ? (n.forEach(e.split("\n"), function(e) {
                  if (i = e.indexOf(":"), t = n.trim(e.substr(0, i)).toLowerCase(), r = n.trim(e.substr(i + 1)), t) {
                      if (a[t] && o.indexOf(t) >= 0) return;
                      a[t] = "set-cookie" === t ? (a[t] ? a[t] : []).concat([r]) : a[t] ? a[t] + ", " + r : r
                  }
              }), a) : a
          }
      }, function(e, t, r) {
          var n = r(0);
          e.exports = n.isStandardBrowserEnv() ? function() {
              var e, t = /(msie|trident)/i.test(navigator.userAgent),
                  r = document.createElement("a");

              function o(e) {
                  var n = e;
                  return t && (r.setAttribute("href", n), n = r.href), r.setAttribute("href", n), {
                      href: r.href,
                      protocol: r.protocol ? r.protocol.replace(/:$/, "") : "",
                      host: r.host,
                      search: r.search ? r.search.replace(/^\?/, "") : "",
                      hash: r.hash ? r.hash.replace(/^#/, "") : "",
                      hostname: r.hostname,
                      port: r.port,
                      pathname: "/" === r.pathname.charAt(0) ? r.pathname : "/" + r.pathname
                  }
              }
              return e = o(window.location.href),
                  function(t) {
                      var r = n.isString(t) ? o(t) : t;
                      return r.protocol === e.protocol && r.host === e.host
                  }
          }() : function() {
              return !0
          }
      }, function(e, t, r) {
          function n() {
              this.message = "String contains an invalid character"
          }
          n.prototype = new Error, n.prototype.code = 5, n.prototype.name = "InvalidCharacterError", e.exports = function(e) {
              for (var t, r, o = String(e), i = "", a = 0, l = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/="; o.charAt(0 | a) || (l = "=", a % 1); i += l.charAt(63 & t >> 8 - a % 1 * 8)) {
                  if ((r = o.charCodeAt(a += .75)) > 255) throw new n;
                  t = t << 8 | r
              }
              return i
          }
      }, function(e, t, r) {
          var n = r(0);
          e.exports = n.isStandardBrowserEnv() ? {
              write: function(e, t, r, o, i, a) {
                  var l = [];
                  l.push(e + "=" + encodeURIComponent(t)), n.isNumber(r) && l.push("expires=" + new Date(r).toGMTString()), n.isString(o) && l.push("path=" + o), n.isString(i) && l.push("domain=" + i), !0 === a && l.push("secure"), document.cookie = l.join("; ")
              },
              read: function(e) {
                  var t = document.cookie.match(new RegExp("(^|;\\s*)(" + e + ")=([^;]*)"));
                  return t ? decodeURIComponent(t[3]) : null
              },
              remove: function(e) {
                  this.write(e, "", Date.now() - 864e5)
              }
          } : {
              write: function() {},
              read: function() {
                  return null
              },
              remove: function() {}
          }
      }, function(e, t, r) {
          var n = r(0);

          function o() {
              this.handlers = []
          }
          o.prototype.use = function(e, t) {
              return this.handlers.push({
                  fulfilled: e,
                  rejected: t
              }), this.handlers.length - 1
          }, o.prototype.eject = function(e) {
              this.handlers[e] && (this.handlers[e] = null)
          }, o.prototype.forEach = function(e) {
              n.forEach(this.handlers, function(t) {
                  null !== t && e(t)
              })
          }, e.exports = o
      }, function(e, t, r) {
          var n = r(0),
              o = r(23),
              i = r(5),
              a = r(1),
              l = r(24),
              s = r(25);

          function u(e) {
              e.cancelToken && e.cancelToken.throwIfRequested()
          }
          e.exports = function(e) {
              return u(e), e.baseURL && !l(e.url) && (e.url = s(e.baseURL, e.url)), e.headers = e.headers || {}, e.data = o(e.data, e.headers, e.transformRequest), e.headers = n.merge(e.headers.common || {}, e.headers[e.method] || {}, e.headers || {}), n.forEach(["delete", "get", "head", "post", "put", "patch", "common"], function(t) {
                  delete e.headers[t]
              }), (e.adapter || a.adapter)(e).then(function(t) {
                  return u(e), t.data = o(t.data, t.headers, e.transformResponse), t
              }, function(t) {
                  return i(t) || (u(e), t && t.response && (t.response.data = o(t.response.data, t.response.headers, e.transformResponse))), Promise.reject(t)
              })
          }
      }, function(e, t, r) {
          var n = r(0);
          e.exports = function(e, t, r) {
              return n.forEach(r, function(r) {
                  e = r(e, t)
              }), e
          }
      }, function(e, t, r) {
          e.exports = function(e) {
              return /^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(e)
          }
      }, function(e, t, r) {
          e.exports = function(e, t) {
              return t ? e.replace(/\/+$/, "") + "/" + t.replace(/^\/+/, "") : e
          }
      }, function(e, t, r) {
          var n = r(6);

          function o(e) {
              if ("function" != typeof e) throw new TypeError("executor must be a function.");
              var t;
              this.promise = new Promise(function(e) {
                  t = e
              });
              var r = this;
              e(function(e) {
                  r.reason || (r.reason = new n(e), t(r.reason))
              })
          }
          o.prototype.throwIfRequested = function() {
              if (this.reason) throw this.reason
          }, o.source = function() {
              var e;
              return {
                  token: new o(function(t) {
                      e = t
                  }),
                  cancel: e
              }
          }, e.exports = o
      }, function(e, t, r) {
          e.exports = function(e) {
              return function(t) {
                  return e.apply(null, t)
              }
          }
      }])
  }, function(e, t, r) {
      r.d(t, "c", function() {
          return o
      }), r.d(t, "d", function() {
          return i
      }), r.d(t, "b", function() {
          return a
      }), r.d(t, "a", function() {
          return l
      });
      var n = r(2);
      r.n(n).a.addLanguage("en-US", {
          NATIVE_NAME: "English (US)",
          ENGLISH_NAME: "English",
          addOption: "Add Option +",
          allFieldsRemoved: "All fields were removed.",
          allowMultipleFiles: "Allow users to upload multiple files",
          autocomplete: "Autocomplete",
          button: "Button",
          cannotBeEmpty: "This field cannot be empty",
          checkboxGroup: "Checkbox Group",
          checkbox: "Checkbox",
          checkboxes: "Checkboxes",
          className: "Class",
          clearAllMessage: "Are you sure you want to clear all fields?",
          clear: "Clear",
          close: "Close",
          content: "Content",
          copy: "Copy To Clipboard",
          copyButton: "&#43;",
          copyButtonTooltip: "Copy",
          dateField: "Date Field",
          description: "Help Text",
          descriptionField: "Description",
          devMode: "Developer Mode",
          editNames: "Edit Names",
          editorTitle: "Form Elements",
          editXML: "Edit XML",
          enableOther: "Enable &quot;Other&quot;",
          enableOtherMsg: "Let users to enter an unlisted option",
          fieldDeleteWarning: "false",
          fieldVars: "Field Variables",
          fieldNonEditable: "This field cannot be edited.",
          fieldRemoveWarning: "Are you sure you want to remove this field?",
          fileUpload: "File Upload",
          formUpdated: "Form Updated",
          getStarted: "Drag a field from the right to this area",
          header: "Header",
          hide: "Edit",
          hidden: "Hidden Input",
          inline: "Inline",
          inlineDesc: "Display {type} inline",
          label: "Label",
          labelEmpty: "Field Label cannot be empty",
          limitRole: "Limit access to one or more of the following roles:",
          mandatory: "Mandatory",
          maxlength: "Max Length",
          minOptionMessage: "This field requires a minimum of 2 options",
          minSelectionRequired: "Minimum {min} selections required",
          multipleFiles: "Multiple Files",
          name: "Name",
          no: "No",
          noFieldsToClear: "There are no fields to clear",
          number: "Number",
          off: "Off",
          on: "On",
          option: "Option",
          optionCount: "Option {count}",
          options: "Options",
          optional: "optional",
          optionLabelPlaceholder: "Label",
          optionValuePlaceholder: "Value",
          optionEmpty: "Option value required",
          other: "Other",
          paragraph: "Paragraph",
          placeholder: "Placeholder",
          "placeholders.value": "Value",
          "placeholders.label": "Label",
          "placeholders.email": "Enter you email",
          "placeholders.className": "space separated classes",
          "placeholders.password": "Enter your password",
          preview: "Preview",
          radioGroup: "Radio Group",
          radio: "Radio",
          removeMessage: "Remove Element",
          removeOption: "Remove Option",
          remove: "&#215;",
          required: "Required",
          requireValidOption: "Only accept a pre-defined Option",
          richText: "Rich Text Editor",
          roles: "Access",
          rows: "Rows",
          save: "Save",
          selectOptions: "Options",
          select: "Select",
          selectColor: "Select Color",
          selectionsMessage: "Allow Multiple Selections",
          size: "Size",
          "size.xs": "Extra Small",
          "size.sm": "Small",
          "size.m": "Default",
          "size.lg": "Large",
          style: "Style",
          "styles.btn.default": "Default",
          "styles.btn.danger": "Danger",
          "styles.btn.info": "Info",
          "styles.btn.primary": "Primary",
          "styles.btn.success": "Success",
          "styles.btn.warning": "Warning",
          subtype: "Type",
          text: "Text Field",
          textArea: "Text Area",
          toggle: "Toggle",
          warning: "Warning!",
          value: "Value",
          viewJSON: "[{&hellip;}]",
          viewXML: "&lt;/&gt;",
          yes: "Yes"
      });
      var o = {
              actionButtons: [],
              allowStageSort: !0,
              append: !1,
              controlOrder: ["autocomplete", "button", "checkbox-group", "checkbox", "date", "file", "header", "hidden", "number", "paragraph", "radio-group", "select", "text", "textarea"],
              controlPosition: "right",
              dataType: "json",
              defaultFields: [],
              disabledActionButtons: [],
              disabledAttrs: [],
              disabledFieldButtons: {},
              disabledSubtypes: {},
              disableFields: [],
              disableHTMLLabels: !1,
              disableInjectedStyle: !1,
              editOnAdd: !1,
              fields: [],
              fieldRemoveWarn: !1,
              fieldEditContainer: null,
              inputSets: [],
              notify: {
                  error: console.error,
                  success: console.log,
                  warning: console.warn
              },
              onAddField: function(e, t) {
                  return e
              },
              onClearAll: function() {
                  return null
              },
              onCloseFieldEdit: function() {
                  return null
              },
              onOpenFieldEdit: function() {
                  return null
              },
              onSave: function(e, t) {
                  return null
              },
              prepend: !1,
              replaceFields: [],
              roles: {
                  1: "Administrator"
              },
              scrollToFieldOnAdd: !0,
              showActionButtons: !0,
              sortableControls: !1,
              stickyControls: {
                  enable: !0,
                  offset: {
                      top: 5,
                      bottom: "auto",
                      right: "auto"
                  }
              },
              subtypes: {},
              templates: {},
              typeUserAttrs: {},
              typeUserDisabledAttrs: {},
              typeUserEvents: {}
          },
          i = {
              btn: ["default", "danger", "info", "primary", "success", "warning"]
          },
          a = {
              location: "https://formbuilder.online/assets/lang/"
          },
          l = {}
  }, function(e, t, r) {
      r.d(t, "d", function() {
          return n
      }), r.d(t, "f", function() {
          return i
      }), r.d(t, "b", function() {
          return a
      }), r.d(t, "c", function() {
          return l
      }), r.d(t, "e", function() {
          return s
      }), r.d(t, "a", function() {
          return f
      });
      var n = {},
          o = {
              text: ["text", "password", "email", "color", "tel"],
              header: ["h1", "h2", "h3"],
              button: ["button", "submit", "reset"],
              paragraph: ["p", "address", "blockquote", "canvas", "output"],
              textarea: ["textarea", "quill"]
          },
          i = function(e) {
              e.parentNode && e.parentNode.removeChild(e)
          },
          a = function(e) {
              for (; e.firstChild;) e.removeChild(e.firstChild);
              return e
          },
          l = function(e, t, r) {
              void 0 === r && (r = !0);
              var n = [],
                  o = ["none", "block"];
              r && (o = o.reverse());
              for (var i = e.length - 1; i >= 0; i--) {
                  -1 !== e[i].textContent.toLowerCase().indexOf(t.toLowerCase()) ? (e[i].style.display = o[0], n.push(e[i])) : e[i].style.display = o[1]
              }
              return n
          },
          s = ["select", "checkbox-group", "checkbox", "radio-group", "autocomplete"],
          u = new RegExp("(" + s.join("|") + ")"),
          f = function() {
              function e(e) {
                  return this.optionFields = s, this.optionFieldsRegEx = u, this.subtypes = o, this.empty = a, this.filter = l, n[e] = this, n[e]
              }
              return e.prototype.onRender = function(e, t) {
                  var r = this;
                  e.parentElement ? t(e) : window.requestAnimationFrame(function() {
                      return r.onRender(e, t)
                  })
              }, e
          }()
  }, function(e, t, r) {
      function n(e) {
          var t;
          return "function" == typeof Event ? t = new Event(e) : (t = document.createEvent("Event")).initEvent(e, !0, !0), t
      }
      var o = {
          loaded: n("loaded"),
          viewData: n("viewData"),
          userDeclined: n("userDeclined"),
          modalClosed: n("modalClosed"),
          modalOpened: n("modalOpened"),
          formSaved: n("formSaved"),
          fieldAdded: n("fieldAdded"),
          fieldRemoved: n("fieldRemoved"),
          fieldRendered: n("fieldRendered"),
          fieldEditOpened: n("fieldEditOpened"),
          fieldEditClosed: n("fieldEditClosed")
      };
      t.a = o
  }, function(e, t, r) {
      r.d(t, "a", function() {
          return l
      });
      var n = r(1),
          o = r(2),
          i = r.n(o);

      function a(e, t) {
          for (var r = 0; r < t.length; r++) {
              var n = t[r];
              n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
          }
      }
      var l = function(e) {
          var t, r, o, l, s;

          function u() {
              return e.apply(this, arguments) || this
          }
          return r = e, (t = u).prototype = Object.create(r.prototype), t.prototype.constructor = t, t.__proto__ = r, u.register = function(e, t) {
              void 0 === e && (e = {}), void 0 === t && (t = []), u.customRegister = {}, u.def || (u.def = {
                  icon: {},
                  i18n: {}
              }), u.templates = e;
              var r = i.a.locale;
              u.def.i18n[r] || (u.def.i18n[r] = {}), n.a.register(Object.keys(e), u);
              var o = t,
                  a = Array.isArray(o),
                  l = 0;
              for (o = a ? o : o[Symbol.iterator]();;) {
                  var s;
                  if (a) {
                      if (l >= o.length) break;
                      s = o[l++]
                  } else {
                      if ((l = o.next()).done) break;
                      s = l.value
                  }
                  var f = s,
                      c = f.type;
                  if (f.attrs = f.attrs || {}, !c) {
                      if (!f.attrs.type) {
                          this.error("Ignoring invalid custom field definition. Please specify a type property.");
                          continue
                      }
                      c = f.attrs.type
                  }
                  var d = f.subtype || c;
                  if (!e[c]) {
                      var p = n.a.getClass(c, f.subtype);
                      if (!p) {
                          this.error("Error while registering custom field: " + c + (f.subtype ? ":" + f.subtype : "") + ". Unable to find any existing defined control or template for rendering.");
                          continue
                      }
                      d = f.datatype ? f.datatype : c + "-" + Math.floor(9e3 * Math.random() + 1e3), u.customRegister[d] = jQuery.extend(f, {
                          type: c,
                          class: p
                      })
                  }
                  u.def.i18n[r][d] = f.label, u.def.icon[d] = f.icon
              }
          }, u.getRegistered = function(e) {
              return void 0 === e && (e = !1), e ? n.a.getRegistered(e) : Object.keys(u.customRegister)
          }, u.lookup = function(e) {
              return u.customRegister[e]
          }, u.prototype.build = function() {
              var e = u.templates[this.type];
              if (!e) return this.error("Invalid custom control type. Please ensure you have registered it correctly as a template option.");
              for (var t = Object.assign(this.config), r = 0, n = ["label", "description", "subtype", "id", "isPreview", "required", "title", "aria-required", "type"]; r < n.length; r++) {
                  var o = n[r];
                  t[o] = this.config[o] || this[o]
              }
              return (e = (e = e.bind(this))(t)).js && (this.js = e.js), e.css && (this.css = e.css), this.onRender = e.onRender, {
                  field: e.field,
                  layout: e.layout
              }
          }, o = u, s = [{
              key: "definition",
              get: function() {
                  return u.def
              }
          }], (l = null) && a(o.prototype, l), s && a(o, s), u
      }(n.a);
      l.customRegister = {}
  }, function(e, t, r) {
      e.exports = function(e) {
          var t = [];
          return t.toString = function() {
              return this.map(function(t) {
                  var r = function(e, t) {
                      var r = e[1] || "",
                          n = e[3];
                      if (!n) return r;
                      if (t && "function" == typeof btoa) {
                          var o = (a = n, "/*# sourceMappingURL=data:application/json;charset=utf-8;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(a)))) + " */"),
                              i = n.sources.map(function(e) {
                                  return "/*# sourceURL=" + n.sourceRoot + e + " */"
                              });
                          return [r].concat(i).concat([o]).join("\n")
                      }
                      var a;
                      return [r].join("\n")
                  }(t, e);
                  return t[2] ? "@media " + t[2] + "{" + r + "}" : r
              }).join("")
          }, t.i = function(e, r) {
              "string" == typeof e && (e = [
                  [null, e, ""]
              ]);
              for (var n = {}, o = 0; o < this.length; o++) {
                  var i = this[o][0];
                  null != i && (n[i] = !0)
              }
              for (o = 0; o < e.length; o++) {
                  var a = e[o];
                  null != a[0] && n[a[0]] || (r && !a[2] ? a[2] = r : r && (a[2] = "(" + a[2] + ") and (" + r + ")"), t.push(a))
              }
          }, t
      }
  }, function(e, t, r) {
      var n, o, i = {},
          a = (n = function() {
              return window && document && document.all && !window.atob
          }, function() {
              return void 0 === o && (o = n.apply(this, arguments)), o
          }),
          l = function(e) {
              var t = {};
              return function(e, r) {
                  if ("function" == typeof e) return e();
                  if (void 0 === t[e]) {
                      var n = function(e, t) {
                          return t ? t.querySelector(e) : document.querySelector(e)
                      }.call(this, e, r);
                      if (window.HTMLIFrameElement && n instanceof window.HTMLIFrameElement) try {
                          n = n.contentDocument.head
                      } catch (e) {
                          n = null
                      }
                      t[e] = n
                  }
                  return t[e]
              }
          }(),
          s = null,
          u = 0,
          f = [],
          c = r(9);

      function d(e, t) {
          for (var r = 0; r < e.length; r++) {
              var n = e[r],
                  o = i[n.id];
              if (o) {
                  o.refs++;
                  for (var a = 0; a < o.parts.length; a++) o.parts[a](n.parts[a]);
                  for (; a < n.parts.length; a++) o.parts.push(v(n.parts[a], t))
              } else {
                  var l = [];
                  for (a = 0; a < n.parts.length; a++) l.push(v(n.parts[a], t));
                  i[n.id] = {
                      id: n.id,
                      refs: 1,
                      parts: l
                  }
              }
          }
      }

      function p(e, t) {
          for (var r = [], n = {}, o = 0; o < e.length; o++) {
              var i = e[o],
                  a = t.base ? i[0] + t.base : i[0],
                  l = {
                      css: i[1],
                      media: i[2],
                      sourceMap: i[3]
                  };
              n[a] ? n[a].parts.push(l) : r.push(n[a] = {
                  id: a,
                  parts: [l]
              })
          }
          return r
      }

      function m(e, t) {
          var r = l(e.insertInto);
          if (!r) throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");
          var n = f[f.length - 1];
          if ("top" === e.insertAt) n ? n.nextSibling ? r.insertBefore(t, n.nextSibling) : r.appendChild(t) : r.insertBefore(t, r.firstChild), f.push(t);
          else if ("bottom" === e.insertAt) r.appendChild(t);
          else {
              if ("object" != typeof e.insertAt || !e.insertAt.before) throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");
              var o = l(e.insertAt.before, r);
              r.insertBefore(t, o)
          }
      }

      function b(e) {
          if (null === e.parentNode) return !1;
          e.parentNode.removeChild(e);
          var t = f.indexOf(e);
          t >= 0 && f.splice(t, 1)
      }

      function h(e) {
          var t = document.createElement("style");
          if (void 0 === e.attrs.type && (e.attrs.type = "text/css"), void 0 === e.attrs.nonce) {
              var n = function() {
                  0;
                  return r.nc
              }();
              n && (e.attrs.nonce = n)
          }
          return g(t, e.attrs), m(e, t), t
      }

      function g(e, t) {
          Object.keys(t).forEach(function(r) {
              e.setAttribute(r, t[r])
          })
      }

      function v(e, t) {
          var r, n, o, i;
          if (t.transform && e.css) {
              if (!(i = "function" == typeof t.transform ? t.transform(e.css) : t.transform.default(e.css))) return function() {};
              e.css = i
          }
          if (t.singleton) {
              var a = u++;
              r = s || (s = h(t)), n = x.bind(null, r, a, !1), o = x.bind(null, r, a, !0)
          } else e.sourceMap && "function" == typeof URL && "function" == typeof URL.createObjectURL && "function" == typeof URL.revokeObjectURL && "function" == typeof Blob && "function" == typeof btoa ? (r = function(e) {
              var t = document.createElement("link");
              return void 0 === e.attrs.type && (e.attrs.type = "text/css"), e.attrs.rel = "stylesheet", g(t, e.attrs), m(e, t), t
          }(t), n = function(e, t, r) {
              var n = r.css,
                  o = r.sourceMap,
                  i = void 0 === t.convertToAbsoluteUrls && o;
              (t.convertToAbsoluteUrls || i) && (n = c(n));
              o && (n += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(o)))) + " */");
              var a = new Blob([n], {
                      type: "text/css"
                  }),
                  l = e.href;
              e.href = URL.createObjectURL(a), l && URL.revokeObjectURL(l)
          }.bind(null, r, t), o = function() {
              b(r), r.href && URL.revokeObjectURL(r.href)
          }) : (r = h(t), n = function(e, t) {
              var r = t.css,
                  n = t.media;
              n && e.setAttribute("media", n);
              if (e.styleSheet) e.styleSheet.cssText = r;
              else {
                  for (; e.firstChild;) e.removeChild(e.firstChild);
                  e.appendChild(document.createTextNode(r))
              }
          }.bind(null, r), o = function() {
              b(r)
          });
          return n(e),
              function(t) {
                  if (t) {
                      if (t.css === e.css && t.media === e.media && t.sourceMap === e.sourceMap) return;
                      n(e = t)
                  } else o()
              }
      }
      e.exports = function(e, t) {
          if ("undefined" != typeof DEBUG && DEBUG && "object" != typeof document) throw new Error("The style-loader cannot be used in a non-browser environment");
          (t = t || {}).attrs = "object" == typeof t.attrs ? t.attrs : {}, t.singleton || "boolean" == typeof t.singleton || (t.singleton = a()), t.insertInto || (t.insertInto = "head"), t.insertAt || (t.insertAt = "bottom");
          var r = p(e, t);
          return d(r, t),
              function(e) {
                  for (var n = [], o = 0; o < r.length; o++) {
                      var a = r[o];
                      (l = i[a.id]).refs--, n.push(l)
                  }
                  e && d(p(e, t), t);
                  for (o = 0; o < n.length; o++) {
                      var l;
                      if (0 === (l = n[o]).refs) {
                          for (var s = 0; s < l.parts.length; s++) l.parts[s]();
                          delete i[l.id]
                      }
                  }
              }
      };
      var y, w = (y = [], function(e, t) {
          return y[e] = t, y.filter(Boolean).join("\n")
      });

      function x(e, t, r, n) {
          var o = r ? "" : n.css;
          if (e.styleSheet) e.styleSheet.cssText = w(t, o);
          else {
              var i = document.createTextNode(o),
                  a = e.childNodes;
              a[t] && e.removeChild(a[t]), a.length ? e.insertBefore(i, a[t]) : e.appendChild(i)
          }
      }
  }, function(e, t) {
      e.exports = function(e) {
          var t = "undefined" != typeof window && window.location;
          if (!t) throw new Error("fixUrls requires window.location");
          if (!e || "string" != typeof e) return e;
          var r = t.protocol + "//" + t.host,
              n = r + t.pathname.replace(/\/[^\/]*$/, "/");
          return e.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function(e, t) {
              var o, i = t.trim().replace(/^"(.*)"$/, function(e, t) {
                  return t
              }).replace(/^'(.*)'$/, function(e, t) {
                  return t
              });
              return /^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(i) ? e : (o = 0 === i.indexOf("//") ? i : 0 === i.indexOf("/") ? r + i : n + i.replace(/^\.\//, ""), "url(" + JSON.stringify(o) + ")")
          })
      }
  }, function(e, t, r) {
      r.d(t, "a", function() {
          return i
      });
      var n = r(0),
          o = function(e, t) {
              var r = e.id ? "fb-" + e.type + " form-group field-" + e.id : "";
              if (e.className) {
                  var n = e.className.split(" ");
                  (n = n.filter(function(e) {
                      return /^col-(xs|sm|md|lg)-([^\s]+)/.test(e) || e.startsWith("row-")
                  })) && n.length > 0 && (r += " " + n.join(" "));
                  for (var o = 0; o < n.length; o++) {
                      var i = n[o];
                      t.classList.remove(i)
                  }
              }
              return r
          },
          i = function() {
              function e(e, t) {
                  var r = this;
                  this.preview = t, this.templates = {
                      label: null,
                      help: null,
                      default: function(e, t, n, i) {
                          return n && t.appendChild(n), r.markup("div", [t, e], {
                              className: o(i, e)
                          })
                      },
                      noLabel: function(e, t, n, i) {
                          return r.markup("div", e, {
                              className: o(i, e)
                          })
                      },
                      hidden: function(e, t, r, n) {
                          return e
                      }
                  }, e && (this.templates = jQuery.extend(this.templates, e)), this.configure()
              }
              var t = e.prototype;
              return t.configure = function() {}, t.build = function(e, t, r) {
                  this.preview && (t.name ? t.name = t.name + "-preview" : t.name = n.f.nameAttr(t) + "-preview"), t.id = t.name, this.data = jQuery.extend({}, t);
                  var o = new e(t, this.preview),
                      i = o.build();
                  "object" == typeof i && i.field || (i = {
                      field: i
                  });
                  var a, l = this.label(),
                      s = this.help();
                  a = r && this.isTemplate(r) ? r : this.isTemplate(i.layout) ? i.layout : "default";
                  var u = this.processTemplate(a, i.field, l, s);
                  return o.on("prerender")(u), u.addEventListener("fieldRendered", o.on("render")), u
              }, t.label = function() {
                  var e = this.data.label || "",
                      t = [n.f.parsedHtml(e)];
                  return this.data.required && t.push(this.markup("span", "*", {
                      className: "fb-required"
                  })), this.isTemplate("label") ? this.processTemplate("label", t) : this.markup("label", t, {
                      for: this.data.id,
                      className: "fb-" + this.data.type + "-label"
                  })
              }, t.help = function() {
                  return this.data.description ? this.isTemplate("help") ? this.processTemplate("help", this.data.description) : this.markup("span", "?", {
                      className: "tooltip-element",
                      tooltip: this.data.description
                  }) : null
              }, t.isTemplate = function(e) {
                  return "function" == typeof this.templates[e]
              }, t.processTemplate = function(e) {
                  for (var t, r = arguments.length, n = new Array(r > 1 ? r - 1 : 0), o = 1; o < r; o++) n[o - 1] = arguments[o];
                  var i = (t = this.templates)[e].apply(t, n.concat([this.data]));
                  return i.jquery && (i = i[0]), i
              }, t.markup = function(e, t, r) {
                  return void 0 === t && (t = ""), void 0 === r && (r = {}), n.f.markup(e, t, r)
              }, e
          }()
  }, function(e, t) {
      e.exports = function(e) {
          var t = typeof e;
          return null != e && ("object" == t || "function" == t)
      }
  }, function(t, r, n) {
      var o = n(1),
          i = n(4);

      function a(e, t) {
          for (var r = 0; r < t.length; r++) {
              var n = t[r];
              n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
          }
      }
      var l = function(t) {
          var r, n;

          function o() {
              return t.apply(this, arguments) || this
          }
          n = t, (r = o).prototype = Object.create(n.prototype), r.prototype.constructor = r, r.__proto__ = n;
          var l, s, u, f = o.prototype;
          return f.build = function() {
              var e = this,
                  t = this.config,
                  r = t.values,
                  n = t.type,
                  o = function(e, t) {
                      if (null == e) return {};
                      var r, n, o = {},
                          i = Object.keys(e);
                      for (n = 0; n < i.length; n++) r = i[n], t.indexOf(r) >= 0 || (o[r] = e[r]);
                      return o
                  }(t, ["values", "type"]),
                  a = function(t) {
                      var r = t.target.nextSibling.nextSibling,
                          n = t.target.nextSibling,
                          o = e.getActiveOption(r),
                          i = new Map([
                              [38, function() {
                                  var t = e.getPreviousOption(o);
                                  t && e.selectOption(r, t)
                              }],
                              [40, function() {
                                  var t = e.getNextOption(o);
                                  t && e.selectOption(r, t)
                              }],
                              [13, function() {
                                  o ? (t.target.value = o.innerHTML, n.value = o.getAttribute("value"), "none" === r.style.display ? e.showList(r, o) : e.hideList(r)) : e.config.requireValidOption && (e.isOptionValid(r, t.target.value) || (t.target.value = "", t.target.nextSibling.value = "")), t.preventDefault()
                              }],
                              [27, function() {
                                  e.hideList(r)
                              }]
                          ]).get(t.keyCode);
                      return i || (i = function() {
                          return !1
                      }), i()
                  },
                  l = {
                      focus: function(t) {
                          var r = t.target.nextSibling.nextSibling,
                              n = Object(i.c)(r.querySelectorAll("li"), t.target.value);
                          if (t.target.addEventListener("keydown", a), t.target.value.length > 0) {
                              var o = n.length > 0 ? n[n.length - 1] : null;
                              e.showList(r, o)
                          }
                      },
                      blur: function(t) {
                          if (t.target.removeEventListener("keydown", a), setTimeout(function() {
                                  t.target.nextSibling.nextSibling.style.display = "none"
                              }, 200), e.config.requireValidOption) {
                              var r = t.target.nextSibling.nextSibling;
                              e.isOptionValid(r, t.target.value) || (t.target.value = "", t.target.nextSibling.value = "")
                          }
                      },
                      input: function(t) {
                          var r = t.target.nextSibling.nextSibling;
                          t.target.nextSibling.value = t.target.value;
                          var n = Object(i.c)(r.querySelectorAll("li"), t.target.value);
                          if (0 == n.length) e.hideList(r);
                          else {
                              var o = e.getActiveOption(r);
                              o || (o = n[n.length - 1]), e.showList(r, o)
                          }
                      }
                  },
                  s = Object.assign({}, o, {
                      id: o.id + "-input",
                      autocomplete: "off",
                      events: l
                  }),
                  u = Object.assign({}, o, {
                      type: "hidden"
                  });
              delete s.name;
              var f = [this.markup("input", null, s), this.markup("input", null, u)],
                  c = r.map(function(t) {
                      var r = t.label,
                          n = {
                              events: {
                                  click: function(r) {
                                      var n = r.target.parentElement,
                                          o = n.previousSibling.previousSibling;
                                      o.value = t.label, o.nextSibling.value = t.value, e.hideList(n)
                                  }
                              },
                              value: t.value
                          };
                      return e.markup("li", r, n)
                  });
              return f.push(this.markup("ul", c, {
                  id: o.id + "-list",
                  className: "fb-" + n + "-list"
              })), f
          }, f.hideList = function(e) {
              this.selectOption(e, null), e.style.display = "none"
          }, f.showList = function(e, t) {
              this.selectOption(e, t), e.style.display = "block", e.style.width = e.parentElement.offsetWidth + "px"
          }, f.getActiveOption = function(e) {
              var t = e.getElementsByClassName("active-option")[0];
              return t && "none" !== t.style.display ? t : null
          }, f.getPreviousOption = function(e) {
              var t = e;
              do {
                  t = t ? t.previousSibling : null
              } while (null != t && "none" === t.style.display);
              return t
          }, f.getNextOption = function(e) {
              var t = e;
              do {
                  t = t ? t.nextSibling : null
              } while (null != t && "none" === t.style.display);
              return t
          }, f.selectOption = function(e, t) {
              for (var r = e.querySelectorAll("li"), n = 0; n < r.length; n++) r[n].classList.remove("active-option");
              t && t.classList.add("active-option")
          }, f.isOptionValid = function(e, t) {
              for (var r = e.querySelectorAll("li"), n = !1, o = 0; o < r.length; o++)
                  if (r[o].innerHTML === t) {
                      n = !0;
                      break
                  }
              return n
          }, f.onRender = function(t) {
              if (this.config.userData) {
                  var r = e("#" + this.config.name),
                      n = r.next(),
                      o = this.config.userData[0],
                      i = null;
                  if (n.find("li").each(function() {
                          e(this).attr("value") !== o || (i = e(this).get(0))
                      }), null === i) return this.config.requireValidOption ? void 0 : void r.prev().val(this.config.userData[0]);
                  r.prev().val(i.innerHTML), r.val(i.getAttribute("value"));
                  var a = r.next().get(0);
                  "none" === a.style.display ? this.showList(a, i) : this.hideList(a)
              }
          }, l = o, u = [{
              key: "definition",
              get: function() {
                  return {
                      mi18n: {
                          requireValidOption: "requireValidOption"
                      }
                  }
              }
          }], (s = null) && a(l.prototype, s), u && a(l, u), o
      }(o.a);
      o.a.register("autocomplete", l);
      var s = function(e) {
          var t, r;

          function n() {
              return e.apply(this, arguments) || this
          }
          return r = e, (t = n).prototype = Object.create(r.prototype), t.prototype.constructor = t, t.__proto__ = r, n.prototype.build = function() {
              return {
                  field: this.markup("button", this.label, this.config),
                  layout: "noLabel"
              }
          }, n
      }(o.a);
      o.a.register("button", s), o.a.register(["button", "submit", "reset"], s, "button");
      var u = n(6);
      var f = function(t) {
          var r, n;

          function o() {
              return t.apply(this, arguments) || this
          }
          n = t, (r = o).prototype = Object.create(n.prototype), r.prototype.constructor = r, r.__proto__ = n;
          var i = o.prototype;
          return i.build = function() {
              return {
                  field: this.markup("input", null, this.config),
                  layout: "hidden"
              }
          }, i.onRender = function() {
              this.config.userData && e("#" + this.config.name).val(this.config.userData[0])
          }, o
      }(o.a);
      o.a.register("hidden", f);
      var c = n(0);
      var d = function(e) {
          var t, r;

          function n() {
              return e.apply(this, arguments) || this
          }
          return r = e, (t = n).prototype = Object.create(r.prototype), t.prototype.constructor = t, t.__proto__ = r, n.prototype.build = function() {
              var e = this.config,
                  t = e.type,
                  r = function(e, t) {
                      if (null == e) return {};
                      var r, n, o = {},
                          i = Object.keys(e);
                      for (n = 0; n < i.length; n++) r = i[n], t.indexOf(r) >= 0 || (o[r] = e[r]);
                      return o
                  }(e, ["type"]),
                  n = t,
                  o = {
                      paragraph: "p",
                      header: this.subtype
                  };
              return o[t] && (n = o[t]), {
                  field: this.markup(n, c.f.parsedHtml(this.label), r),
                  layout: "noLabel"
              }
          }, n
      }(o.a);

      function p(e, t) {
          if (null == e) return {};
          var r, n, o = {},
              i = Object.keys(e);
          for (n = 0; n < i.length; n++) r = i[n], t.indexOf(r) >= 0 || (o[r] = e[r]);
          return o
      }

      function m(e, t) {
          for (var r = 0; r < t.length; r++) {
              var n = t[r];
              n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
          }
      }
      o.a.register(["paragraph", "header"], d), o.a.register(["p", "address", "blockquote", "canvas", "output"], d, "paragraph"), o.a.register(["h1", "h2", "h3", "h4"], d, "header");
      var b = function(t) {
          var r, n;

          function i() {
              return t.apply(this, arguments) || this
          }
          n = t, (r = i).prototype = Object.create(n.prototype), r.prototype.constructor = r, r.__proto__ = n;
          var a, l, s, u = i.prototype;
          return u.build = function() {
              var e = [],
                  t = this.config,
                  r = t.values,
                  n = t.value,
                  o = t.placeholder,
                  i = t.type,
                  a = t.inline,
                  l = t.other,
                  s = t.toggle,
                  u = p(t, ["values", "value", "placeholder", "type", "inline", "other", "toggle"]),
                  f = i.replace("-group", ""),
                  c = "select" === i;
              if ((u.multiple || "checkbox-group" === i) && (u.name = u.name + "[]"), "checkbox-group" === i && u.required && (this.onRender = this.groupRequired), delete u.title, r) {
                  o && c && e.push(this.markup("option", o, {
                      disabled: null,
                      selected: null
                  }));
                  for (var d = 0; d < r.length; d++) {
                      var m = r[d];
                      "string" == typeof m && (m = {
                          label: m,
                          value: m
                      });
                      var b = m,
                          h = b.label,
                          g = void 0 === h ? "" : h;
                      if ((j = p(b, ["label"])).id = u.id + "-" + d, j.selected && !o || delete j.selected, void 0 !== n && j.value === n && (j.selected = !0), c) {
                          var v = this.markup("option", document.createTextNode(g), j);
                          e.push(v)
                      } else {
                          var y = [g],
                              w = "fb-" + f;
                          a && (w += "-inline"), j.type = f, j.selected && (j.checked = "checked", delete j.selected);
                          var x = this.markup("input", null, Object.assign({}, u, j)),
                              A = {
                                  for: j.id
                              },
                              O = [x, this.markup("label", y, A)];
                          s && (A.className = "kc-toggle", y.unshift(x, this.markup("span")), O = this.markup("label", y, A));
                          var k = this.markup("div", O, {
                              className: w
                          });
                          e.push(k)
                      }
                  }
                  if (!c && l) {
                      var j, q = {
                              id: u.id + "-other",
                              className: u.className + " other-option",
                              value: ""
                          },
                          C = "fb-" + f;
                      a && (C += "-inline"), (j = Object.assign({}, u, q)).type = f;
                      var E = {
                              type: "text",
                              events: {
                                  input: function(e) {
                                      var t = e.target;
                                      t.parentElement.previousElementSibling.value = t.value
                                  }
                              },
                              id: q.id + "-value",
                              className: "other-val"
                          },
                          L = this.markup("input", null, j),
                          N = [document.createTextNode("Other"), this.markup("input", null, E)],
                          S = this.markup("label", N, {
                              for: j.id
                          }),
                          T = this.markup("div", [L, S], {
                              className: C
                          });
                      e.push(T)
                  }
              }
              return this.dom = "select" == i ? this.markup(f, e, u) : this.markup("div", e, {
                  className: i
              }), this.dom
          }, u.groupRequired = function() {
              for (var e = this.element.getElementsByTagName("input"), t = function(e, t) {
                      [].forEach.call(e, function(e) {
                          t ? e.removeAttribute("required") : e.setAttribute("required", "required"),
                              function(e, t) {
                                  var r = o.a.mi18n("minSelectionRequired", 1);
                                  t ? e.setCustomValidity("") : e.setCustomValidity(r)
                              }(e, t)
                      })
                  }, r = function() {
                      var r = [].some.call(e, function(e) {
                          return e.checked
                      });
                      t(e, r)
                  }, n = e.length - 1; n >= 0; n--) e[n].addEventListener("change", r);
              r()
          }, u.onRender = function() {
              if (this.config.userData) {
                  var t = this.config.userData.slice();
                  "select" === this.config.type ? e(this.dom).val(t).prop("selected", !0) : this.config.type.endsWith("-group") && this.dom.querySelectorAll("input").forEach(function(e) {
                      if (!e.classList.contains("other-val")) {
                          for (var r = 0; r < t.length; r++)
                              if (e.value === t[r]) {
                                  e.setAttribute("checked", !0), t.splice(r, 1);
                                  break
                              }
                          if (e.id.endsWith("-other")) {
                              var n = document.getElementById(e.id + "-value");
                              if (0 === t.length) return;
                              e.setAttribute("checked", !0), n.value = e.value = t[0], n.style.display = "inline-block"
                          }
                      }
                  })
              }
          }, a = i, s = [{
              key: "definition",
              get: function() {
                  return {
                      inactive: ["checkbox"],
                      mi18n: {
                          minSelectionRequired: "minSelectionRequired"
                      }
                  }
              }
          }], (l = null) && m(a.prototype, l), s && m(a, s), i
      }(o.a);

      function h(e, t) {
          for (var r = 0; r < t.length; r++) {
              var n = t[r];
              n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
          }
      }
      o.a.register(["select", "checkbox-group", "radio-group", "checkbox"], b);
      var g = function(t) {
          var r, n;

          function o() {
              return t.apply(this, arguments) || this
          }
          n = t, (r = o).prototype = Object.create(n.prototype), r.prototype.constructor = r, r.__proto__ = n;
          var i, a, l, s = o.prototype;
          return s.build = function() {
              var e = this.config.name;
              e = this.config.multiple ? e + "[]" : e;
              var t = Object.assign({}, this.config, {
                  name: e
              });
              return this.dom = this.markup("input", null, t), this.dom
          }, s.onRender = function() {
              this.config.userData && e(this.dom).val(this.config.userData[0])
          }, i = o, l = [{
              key: "definition",
              get: function() {
                  return {
                      mi18n: {
                          date: "dateField",
                          file: "fileUpload"
                      }
                  }
              }
          }], (a = null) && h(i.prototype, a), l && h(i, l), o
      }(o.a);

      function v(e, t) {
          for (var r = 0; r < t.length; r++) {
              var n = t[r];
              n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
          }
      }
      o.a.register(["text", "file", "date", "number"], g), o.a.register(["text", "password", "email", "color", "tel"], g, "text");
      var y = function(t) {
          var r, n;

          function o() {
              return t.apply(this, arguments) || this
          }
          n = t, (r = o).prototype = Object.create(n.prototype), r.prototype.constructor = r, r.__proto__ = n;
          var i, a, l, s = o.prototype;
          return s.configure = function() {
              var t = this;
              this.js = this.classConfig.js || "//cdnjs.cloudflare.com/ajax/libs/file-uploader/5.14.2/jquery.fine-uploader/jquery.fine-uploader.min.js", this.css = [this.classConfig.css || "//cdnjs.cloudflare.com/ajax/libs/file-uploader/5.14.2/jquery.fine-uploader/fine-uploader-gallery.min.css", {
                  type: "inline",
                  id: "fineuploader-inline",
                  style: "\n          .qq-uploader .qq-error-message {\n            position: absolute;\n            left: 20%;\n            top: 20px;\n            width: 60%;\n            color: #a94442;\n            background: #f2dede;\n            border: solid 1px #ebccd1;\n            padding: 15px;\n            line-height: 1.5em;\n            text-align: center;\n            z-index: 99999;\n          }\n          .qq-uploader .qq-error-message span {\n            display: inline-block;\n            text-align: left;\n          }"
              }], this.handler = this.classConfig.handler || "/upload", ["js", "css", "handler"].forEach(function(e) {
                  return delete t.classConfig[e]
              });
              var r = this.classConfig.template || '\n      <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">\n        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">\n          <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>\n        </div>\n        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>\n          <span class="qq-upload-drop-area-text-selector"></span>\n        </div>\n        <div class="qq-upload-button-selector qq-upload-button">\n          <div>Upload a file</div>\n        </div>\n        <span class="qq-drop-processing-selector qq-drop-processing">\n          <span>Processing dropped files...</span>\n          <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>\n        </span>\n        <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">\n          <li>\n            <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>\n            <div class="qq-progress-bar-container-selector qq-progress-bar-container">\n              <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>\n            </div>\n            <span class="qq-upload-spinner-selector qq-upload-spinner"></span>\n            <div class="qq-thumbnail-wrapper">\n              <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>\n            </div>\n            <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>\n            <button type="button" class="qq-upload-retry-selector qq-upload-retry">\n              <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>\n              Retry\n            </button>\n            <div class="qq-file-info">\n              <div class="qq-file-name">\n                <span class="qq-upload-file-selector qq-upload-file"></span>\n                <span class="qq-edit-filename-icon-selector qq-btn qq-edit-filename-icon" aria-label="Edit filename"></span>\n              </div>\n              <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">\n              <span class="qq-upload-size-selector qq-upload-size"></span>\n              <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">\n                <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>\n              </button>\n              <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">\n                <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>\n              </button>\n              <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">\n                <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>\n              </button>\n            </div>\n          </li>\n        </ul>\n        <dialog class="qq-alert-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">Close</button>\n          </div>\n        </dialog>\n        <dialog class="qq-confirm-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">No</button>\n            <button type="button" class="qq-ok-button-selector">Yes</button>\n          </div>\n        </dialog>\n        <dialog class="qq-prompt-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <input type="text">\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">Cancel</button>\n            <button type="button" class="qq-ok-button-selector">Ok</button>\n          </div>\n        </dialog>\n      </div>';
              this.fineTemplate = e("<div/>").attr("id", "qq-template").html(r)
          }, s.build = function() {
              return this.input = this.markup("input", null, {
                  type: "hidden",
                  name: this.config.name,
                  id: this.config.name
              }), this.wrapper = this.markup("div", "", {
                  id: this.config.name + "-wrapper"
              }), [this.input, this.wrapper]
          }, s.onRender = function() {
              var t = e(this.wrapper),
                  r = e(this.input),
                  n = jQuery.extend(!0, {
                      request: {
                          endpoint: this.handler
                      },
                      deleteFile: {
                          enabled: !0,
                          endpoint: this.handler
                      },
                      chunking: {
                          enabled: !0,
                          concurrent: {
                              enabled: !0
                          },
                          success: {
                              endpoint: this.handler + (-1 == this.handler.indexOf("?") ? "?" : "&") + "done"
                          }
                      },
                      resume: {
                          enabled: !0
                      },
                      retry: {
                          enableAuto: !0,
                          showButton: !0
                      },
                      callbacks: {
                          onError: function(r, n, o, i) {
                              "." != o.slice(-1) && (o += ".");
                              var a = e("<div />").addClass("qq-error-message").html("<span>Error processing upload: <b>" + n + "</b>.<br />Reason: " + o + "</span>").prependTo(t.find(".qq-uploader"));
                              setTimeout(function() {
                                  a.fadeOut(function() {
                                      a.remove()
                                  })
                              }, 6e3)
                          },
                          onStatusChange: function(e, n, o) {
                              var i = [],
                                  a = t.fineUploader("getUploads"),
                                  l = Array.isArray(a),
                                  s = 0;
                              for (a = l ? a : a[Symbol.iterator]();;) {
                                  var u;
                                  if (l) {
                                      if (s >= a.length) break;
                                      u = a[s++]
                                  } else {
                                      if ((s = a.next()).done) break;
                                      u = s.value
                                  }
                                  var f = u;
                                  "upload successful" == f.status && i.push(f.name)
                              }
                              r.val(i.join(", "))
                          }
                      },
                      template: this.fineTemplate
                  }, this.classConfig);
              t.fineUploader(n)
          }, i = o, l = [{
              key: "definition",
              get: function() {
                  return {
                      i18n: {
                          default: "Fine Uploader"
                      }
                  }
              }
          }], (a = null) && v(i.prototype, a), l && v(i, l), o
      }(g);

      function w(e, t) {
          for (var r = 0; r < t.length; r++) {
              var n = t[r];
              n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
          }
      }
      g.register("file", g, "file"), g.register("fineuploader", y, "file");
      var x = function(t) {
          var r, n;

          function o() {
              return t.apply(this, arguments) || this
          }
          n = t, (r = o).prototype = Object.create(n.prototype), r.prototype.constructor = r, r.__proto__ = n;
          var i, a, l, s = o.prototype;
          return s.build = function() {
              var e = this.config,
                  t = e.value,
                  r = void 0 === t ? "" : t,
                  n = function(e, t) {
                      if (null == e) return {};
                      var r, n, o = {},
                          i = Object.keys(e);
                      for (n = 0; n < i.length; n++) r = i[n], t.indexOf(r) >= 0 || (o[r] = e[r]);
                      return o
                  }(e, ["value"]);
              return this.field = this.markup("textarea", this.parsedHtml(r), n), this.field
          }, s.onRender = function() {
              this.config.userData && e("#" + this.config.name).val(this.config.userData[0])
          }, s.on = function(r) {
              var n = this;
              return "prerender" == r && this.preview ? function(t) {
                  n.field && (t = n.field), e(t).on("mousedown", function(e) {
                      e.stopPropagation()
                  })
              } : t.prototype.on.call(this, r)
          }, i = o, l = [{
              key: "definition",
              get: function() {
                  return {
                      mi18n: {
                          textarea: "textArea"
                      }
                  }
              }
          }], (a = null) && w(i.prototype, a), l && w(i, l), o
      }(o.a);
      o.a.register("textarea", x), o.a.register("textarea", x, "textarea");
      var A = function(e) {
          var t, r;

          function n() {
              return e.apply(this, arguments) || this
          }
          r = e, (t = n).prototype = Object.create(r.prototype), t.prototype.constructor = t, t.__proto__ = r;
          var o = n.prototype;
          return o.configure = function() {
              if (this.js = ["https://cdn.tinymce.com/4/tinymce.min.js"], this.classConfig.js) {
                  var e = this.classConfig.js;
                  Array.isArray(e) || (e = new Array(e)), this.js.concat(e), delete this.classConfig.js
              }
              this.classConfig.css && (this.css = this.classConfig.css), this.editorOptions = {
                  height: 250,
                  paste_data_images: !0,
                  plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste code"],
                  toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | table"
              }
          }, o.build = function() {
              var e = this.config,
                  t = e.value,
                  r = void 0 === t ? "" : t,
                  n = function(e, t) {
                      if (null == e) return {};
                      var r, n, o = {},
                          i = Object.keys(e);
                      for (n = 0; n < i.length; n++) r = i[n], t.indexOf(r) >= 0 || (o[r] = e[r]);
                      return o
                  }(e, ["value"]);
              return this.field = this.markup("textarea", this.parsedHtml(r), n), n.disabled && (this.editorOptions.readonly = !0), this.field
          }, o.onRender = function(e) {
              window.tinymce.editors[this.id] && window.tinymce.editors[this.id].remove();
              var t = jQuery.extend(this.editorOptions, this.classConfig);
              t.target = this.field, window.tinymce.init(t), this.config.userData && window.tinymce.editors[this.id].setContent(this.parsedHtml(this.config.userData[0]))
          }, n
      }(x);

      function O(e) {
          for (var t = 1; t < arguments.length; t++) {
              var r = null != arguments[t] ? arguments[t] : {},
                  n = Object.keys(r);
              "function" == typeof Object.getOwnPropertySymbols && (n = n.concat(Object.getOwnPropertySymbols(r).filter(function(e) {
                  return Object.getOwnPropertyDescriptor(r, e).enumerable
              }))), n.forEach(function(t) {
                  k(e, t, r[t])
              })
          }
          return e
      }

      function k(e, t, r) {
          return t in e ? Object.defineProperty(e, t, {
              value: r,
              enumerable: !0,
              configurable: !0,
              writable: !0
          }) : e[t] = r, e
      }
      x.register("tinymce", A, "textarea");
      var j = function(e) {
          var t, r;

          function n() {
              return e.apply(this, arguments) || this
          }
          r = e, (t = n).prototype = Object.create(r.prototype), t.prototype.constructor = t, t.__proto__ = r;
          var o = n.prototype;
          return o.configure = function() {
              var e = {
                      modules: {
                          toolbar: [
                              [{
                                  header: [1, 2, !1]
                              }],
                              ["bold", "italic", "underline"],
                              ["code-block"]
                          ]
                      },
                      placeholder: this.config.placeholder || "",
                      theme: "snow"
                  },
                  t = c.f.splitObject(this.classConfig, ["css", "js"]),
                  r = t[0],
                  n = t[1];
              Object.assign(this, O({}, {
                  js: "//cdn.quilljs.com/1.2.4/quill.js",
                  css: "//cdn.quilljs.com/1.2.4/quill.snow.css"
              }, r)), this.editorConfig = O({}, e, n)
          }, o.build = function() {
              var e = this.config,
                  t = (e.value, function(e, t) {
                      if (null == e) return {};
                      var r, n, o = {},
                          i = Object.keys(e);
                      for (n = 0; n < i.length; n++) r = i[n], t.indexOf(r) >= 0 || (o[r] = e[r]);
                      return o
                  }(e, ["value"]));
              return this.field = this.markup("div", null, t), this.field
          }, o.onRender = function(e) {
              var t = this.config.value || "",
                  r = window.Quill.import("delta");
              window.fbEditors.quill[this.id] = {};
              var n = window.fbEditors.quill[this.id];
              n.instance = new window.Quill(this.field, this.editorConfig), n.data = new r, t && n.instance.setContents(window.JSON.parse(this.parsedHtml(t))), n.instance.on("text-change", function(e) {
                  n.data = n.data.compose(e)
              })
          }, n
      }(x);
      x.register("quill", j, "textarea");
      u.a
  }, function(e, t, r) {
      var n = r(20),
          o = "object" == typeof self && self && self.Object === Object && self,
          i = n || o || Function("return this")();
      e.exports = i
  }, function(e, t, r) {
      var n = r(13).Symbol;
      e.exports = n
  }, function(e, t, r) {
      var n = r(18),
          o = r(11),
          i = "Expected a function";
      e.exports = function(e, t, r) {
          var a = !0,
              l = !0;
          if ("function" != typeof e) throw new TypeError(i);
          return o(r) && (a = "leading" in r ? !!r.leading : a, l = "trailing" in r ? !!r.trailing : l), n(e, t, {
              leading: a,
              maxWait: t,
              trailing: l
          })
      }
  }, function(e, t, r) {
      var n = r(17);
      "string" == typeof n && (n = [
          [e.i, n, ""]
      ]);
      var o = {
          attrs: {
              class: "formBuilder-injected-style"
          },
          sourceMap: !1,
          hmr: !0,
          transform: void 0,
          insertInto: void 0
      };
      r(8)(n, o);
      n.locals && (e.exports = n.locals)
  }, function(e, t, r) {
      (e.exports = r(7)(!1)).push([e.i, "@font-face{font-family:'fb-icons';src:url(\"data:application/octet-stream;base64,d09GRgABAAAAABucAA8AAAAAMXwAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAABHU1VCAAABWAAAADsAAABUIIslek9TLzIAAAGUAAAAQwAAAFY+IFOTY21hcAAAAdgAAACqAAACbnpHyFBjdnQgAAAChAAAABMAAAAgBtX/BGZwZ20AAAKYAAAFkAAAC3CKkZBZZ2FzcAAACCgAAAAIAAAACAAAABBnbHlmAAAIMAAAEA4AAByklMHRx2hlYWQAABhAAAAAMgAAADYRnnjNaGhlYQAAGHQAAAAdAAAAJAc8A2VobXR4AAAYlAAAACEAAABMRoz//2xvY2EAABi4AAAAKAAAAChJjFGYbWF4cAAAGOAAAAAgAAAAIAKGDJhuYW1lAAAZAAAAAYQAAALNmU1ky3Bvc3QAABqEAAAAmwAAAN59hsARcHJlcAAAGyAAAAB6AAAAhuVBK7x4nGNgZGBg4GIwYLBjYHJx8wlh4MtJLMljkGJgYYAAkDwymzEnMz2RgQPGA8qxgGkOIGaDiAIAJjsFSAB4nGNgZN7OOIGBlYGBqYppDwMDQw+EZnzAYMjIBBRlYGVmwAoC0lxTGBxeMHzyZQ76n8UQxRzEMA0ozAiSAwABCQw7AHic7ZHLFYJADEXvAOIP5FOCC1e2ws6CXFlr1jSgL5OUYTiXScIMcHKBA9CKp+igfCh4vNUttd9yqf2Ol+qTrgZstGXfvl9l2BRZjaLndx41a3S20xd6juqe9Z4rAyM3JmYWVm3q+cdQ75bVGmktZcCSOvXEjVni1ixxm5Zo6lii+WOJTGCJnGCJW7ZEnrDE/84SuZP5QBZlPsDXOcDXJZBj9i1g/QFjZzHOAAB4nGNgQAMSEMgc9D8LhAESbAPdAHicrVZpd9NGFB15SZyELCULLWphxMRpsEYmbMGACUGyYyBdnK2VoIsUO+m+8Ynf4F/zZNpz6Dd+Wu8bLySQtOdwmpOjd+fN1czbZRJaktgL65GUmy/F1NYmjew8CemGTctRfCg7eyFlisnfBVEQrZbatx2HREQiULWusEQQ+x5ZmmR86FFGy7akV03KLT3pLlvjQb1V334aOsqxO6GkZjN0aD2yJVUYVaJIpj1S0qZlqPorSSu8v8LMV81QwohOImm8GcbQSN4bZ7TKaDW24yiKbLLcKFIkmuFBFHmU1RLn5IoJDMoHzZDyyqcR5cP8iKzYo5xWsEu20/y+L3mndzk/sV9vUbbkQB/Ijuzg7HQlX4RbW2HctJPtKFQRdtd3QmzZ7FT/Zo/ymkYDtysyvdCMYKl8hRArP6HM/iFZLZxP+ZJHo1qykRNB62VO7Es+gdbjiClxzRhZ0N3RCRHU/ZIzDPaYPh788d4plgsTAngcy3pHJZwIEylhczRJ2jByYCVliyqp9a6YOOV1WsRbwn7t2tGXzmjjUHdiPFsPHVs5UcnxaFKnmUyd2knNoykNopR0JnjMrwMoP6JJXm1jNYmVR9M4ZsaERCICLdxLU0EsO7GkKQTNoxm9uRumuXYtWqTJA/Xco/f05la4udNT2g70s0Z/VqdiOtgL0+lp5C/xadrlIkXp+ukZfkziQdYCMpEtNsOUgwdv/Q7Sy9eWHIXXBtju7fMrqH3WRPCkAfsb0B5P1SkJTIWYVYhWQGKta1mWydWsFqnI1HdDmla+rNMEinIcF8e+jHH9XzMzlpgSvt+J07MjLj1z7UsI0xx8m3U9mtepxXIBcWZ5TqdZlu/rNMfyA53mWZ7X6QhLW6ejLD/UaYHlRzodY3lBC5p038GQizDkAg6QMISlA0NYXoIhLBUMYbkIQ1gWYQjLJRjC8mMYwnIZhrC8rGXV1FNJ49qZWAZsQmBijh65zEXlaiq5VEK7aFRqQ54SbpVUFM+qf2WgXjzyhjmwFkiXyJpfMc6Vj0bl+NYVLW8aO1fAsepvH472OfFS1ouFPwX/1dZUJb1izcOTq/Abhp5sJ6o2qXh0TZfPVT26/l9UVFgL9BtIhVgoyrJscGcihI86nYZqoJVDzGzMPLTrdcuan8P9NzFCFlD9+DcUGgvcg05ZSVnt4KzV19uy3DuDcjgTLEkxN/P6VvgiI7PSfpFZyp6PfB5wBYxKZdhqA60VvNknMQ+Z3iTPBHFbUTZI2tjOBIkNHPOAefOdBCZh6qoN5E7hhg34BWFuwXknXKJ6oyyH7kXs8yik/Fun4kT2qGiMwLPZG2Gv70LKb3EMJDT5pX4MVBWhqRg1FdA0Um6oBl/G2bptQsYO9CMqdsOyrOLDxxb3lZJtGYR8pIjVo6Of1l6iTqrcfmYUl++dvgXBIDUxf3vfdHGQyrtayTJHbQNTtxqVU9eaQ+NVh+rmUfW94+wTOWuabronHnpf06rbwcVcLLD2bQ7SUiYX1PVhhQ2iy8WlUOplNEnvuAcYFhjQ71CKjf+r+th8nitVhdFxJN9O1LfR52AM/A/Yf0f1A9D3Y+hyDS7P95oTn2704WyZrqIX66foNzBrrblZugbc0HQD4iFHrY64yg18pwZxeqS5HOkh4GPdFeIBwCaAxeAT3bWM5lMAo/mMOT7A58xh0GQOgy3mMNhmzhrADnMY7DKHwR5zGHzBnHWAL5nDIGQOg4g5DJ4wJwB4yhwGXzGHwdfMYfANc+4DfMscBjFzGCTMYbCv6dYwzC1e0F2gtkFVoANTT1jcw+JQU2XI/o4Xhv29Qcz+wSCm/qjp9pD6Ey8M9WeDmPqLQUz9VdOdIfU3Xhjq7wYx9Q+DmPpMvxjLZQa/jHyXCgeUXWw+5++J9w/bxUC5AAEAAf//AA94nM1ZW3Bbx3nef88VwMEBDnAO7iAuBxcRoEQKV0qkAEiiREqkJJKmJFKyQNY0HVc0TSlJq9ox7TZynKgvrmcqT6dR22EznXGcTOvIE+fB6kynkpt6PHamje126pdOXyq/+KHNS2EB6r+40KwkZ9xkPJPF2QvP7v5nd//b9y+Jk5C757nb3CzhiERsxEHcxEuCJEJMkiZZMkmmyRyZJ8/Q0cnX9On52ks8UHOHSVesICcTSTmxRhKZZCKzGoOIZ8ATWSED0ejAsu7WOEdYDTtWDJeTU/v61OUQ+PrBpD5ziexID9kHeYnskOoCR4nNQkEkUE8pVCRJWUzWd0FmZ5Z6IhnPYi6+m4uSsCMaXgyC3x84RQIBZYL09XkXiNdr9x4JTr5m4ML+uLuwHWufs7KBtQcvLaz2rX5pa6u9/IWW5RmIrm6tS1378he2sFA7f/LkzIzPpyhP/96l3/2dr3/tqxfXzz/+lcdWHl1+5LeWFuvnzp6cPzl/+tTM3MzcQ7PTJ45PHRk/fGjs4IH9tcpwMTeUzfTvSKeSCTMei0b6wiFf0BcM+L0eQ3e7NKfiUBwujSVnXghmIW+YadPIlzHjU8TH9GJOY4PrtllmnWDoKmRB00UzFk8VtUIF8rGiWYwZphHL9QHXD0YsWWRkTAMKKTOmmdidb+dYXAyD7sm3B7NJuVIRLlWrG5UKPo1qu6pWb+Cb9oMN+HEg64/EQ01XyMQWvLwBezbgtD8beLN1pXWFftJ8EYfR11xq6/s4v1JpnVc1Te2NU100wMhXqt2y2ny32k70jxr+TKD1nVA8HqI/Q3o4uxrINt+/8SkjA++rrtZPqxX8udSGquHUiqYSgjrIdHLzgTqZJ2UyQqrkBPka+ZPa1f1JGnYd2Zng3GE6HovQsNsSnguC2++1cxbZbVn0eRRONjSJE3hZqOtOkeMdNo4DwkM9AC5X33wU+vqUCdVKOUJC8yQUsoeOfPXC2vmvPLa8dO7sqYeOTR0aq1b2jY7s3TNcLhULuwf70z2eI8N9XY53kzMuhLM9bqa31XBPzRULKaQjSobuKedzJdg2vtzt83b7yp/JQmkEiqzIecI4o9OSjHzOM765+db162/1Svju669/eP06/HBz88PXX7+liAnJCp3yu+1XH25uuqyyKSmApWz9l4HQnU/CmUx4ooBKWviwlDCTJRgPZ05sbm4mrl+/nths3tpssCJxHYY229Q22exWCvs2N1e3vRpoFhkp+k44U0oWCslSp8wgbyny9h+5/6B/T3TST3K1wfYBuonEURjXAQ4RIJQDuoS8J9wc4Tg0vtieKo6UC7zgY3qhAh7GLuhqRs7jLUsWEJJFpgpx0dCY+KPYc1Mozc33UO6wprlY3vryB633W+9BDgY0tfme6nKpNKdqNNBSeoOwzsRO/3frKrz86BsKE/POOCLjul95oJ94srYaBl6IgIX3g2wJgigbIInCeB8IAbB4QOQOe0Eaw4kU7VbdCgLhLQJfJxYiixa5TkQbjpfO4OnAKQKgkCOKIss9K6LaZZtsYwLmVAR/VouhIcAsYKFhs4htB6S9bqmTudt3fCzDJZpvvsvyxrV6/Vo3c3rlzcqbHRVtVG/Uo8/CG/XoBvwYC9zV/XuMIpeKpIJ+cA6Ejgc8Q2xUoLaVILgsrgtsWzbclk+hgh14q8AvecFKHKLVsUREImmihIrmJJrq1Jb8oBK3rLqXQjqVDQ+1uGTL0rZ9B2tnO8SFtS+B+kLtwLGpWrVcymbiMUN3Omemp+aOzR0+VJ2sTY7sLVXKldxQppgtppKx/nh/MKBHjajT7dzSbmcYlXuLAe1sMA4YHIojCiMaZxTOdFzUPblSIdV9i8qpi/e+vHdoj2t76MXmi738UVssc23ZRFkMoTh2BDVdLqfxRdDlst83pM3iRpX9qvBGINPuy2UCGy7sDLla32wPL84WN3C0oRutF7vzsXi2MwbPzOjKgr5N0juW9yAZR2k4QR4ip8lZskgukW+Q58hl8m1u/+RrFpSPPyOj0og0unIYhsuiOLyyDwgpFUmpjoJUyBQL9fzuwZ18tj8RDfkEymXp4o5DyYOx/eGq38Klx8wDkVqw4rXwAsfXU/G+gEcQDLfmsAs2RbDVc0O7BviM7nKqvGLNKHViJRbZaqmjhkqjslTHNe7dM7K3TvaQ8vCeMmoXgDhLRBEWCIhwDNGSFRf5l79skQO4SJLJ0szsr7tUbqC70oFfaaU2XOmfb19peVhc+w07z9pfdBY4svYbusIFxHp/9cwzc3PT01NTExNjY7Xa6OjwMCXffuFbz1/+5h/8/jPPPfPcsxvfePqpHg68sP7k2hOr53+7gwYZFnz47JmF+bnTc6dPnZx+aPqh2ZmpE1Mnjh+bmJyYPHpkbHwMkWHtYA2x4Wh1FMHC8MgwwgWGFvK53UODu3YO3IsWtyEHp1UiDuoYF/QsbPdfWiElIGw0MEOMWZ32L4+w776cNMx9NG94H1j1oCGCROP+3KYKXUeSxsy9eudqyDRD3CritjtP5TBxq3eu9nLu3OzpmfpkfaY+0FyfnH1lZub7k5N/MzPzh2xgrj4zz7omz3XnNF0dW7bRUuAXnB4PM5BphugnIfN5l93dvEIH7G7Fbd9KEbfbjlbtvjKKhV1UesmvuJtXGYCtVAlxbvktBds68ZEQ+q0E2UEGyBApkGEy2rFbUOx4sMeCYOMUzrZCFJ5Xlv1eaggewVgJ+KhHFD3LcV1z8HZJlewrbhaJyLK6bAG+L0QhzMNiImJyYSIYYaHOfJBdlBZjgABBJueswHH0VBQoVTj0Zk90P6Ss4Zc4hV/tfcqz1v6W4BFXP/uYutb5mqTKq7/C5xZqJ5ls79xpoPHeLpPVyhZ4RXHcObQTJfJBAmn4DJTJtkgi6sDDVNyFpODBkGB3TyTzWtvldd2eG8WKiaiGudzLKFPJbX9DOi90BRX5fjEUb9w5/ZmPa9y4cefnLFboRSOtK702fFC9dOd/kMHcbEcgaR6GKzfevIFz6MUb1Urz3Uo3NdolXDjUYKTwkHq+q4djWOTwkw7v9xOE/jxZUQCsPFhXiayCTZRt7bPlEE70cJqd4TTCcJrVYrHOEqvVskAsVgtavAMdGrD2qxNZqKWiURm5GDWjyIK+oMeNZ64wqGe1IHrkkQKnOQQjW8aDTqJehiG2D/Dg3dr/xbmcFtNuwC9aymen+mY89JkOV+5c/R47Ihb+4Zkx1euqIWdF9fyEoWty9z+52/SD7q3H2do8w+AIxKHOq5TYwWoj1rrioDbE2aJNWJJBlCRxFitROkUQvB6NRoEwcepsJ9CzbQ6rzDaD4XoEIs62hWOWiNm0zg5GwGgHssWuxQMUsX7Q0Ao11+uN+rVgwgxdwwZ9KRQ37zx9jf6suU5fovMslEz5WldCJgsbzRBc8qVak3CpdQUuIXzBQyd3f8Qdo3eRIzrxozV4oebtAyqEPaqE6/FzGO/hHjEQHJ98zYWCkSYCFdZx43Sdnf064kYgy+hLeB5msQL+NOP6ZLCWun8kWb9/4EINgVQs6vM6HRYZlyHqErLTW05jvIZxuxmXQDT0fK4MpbQXzCLoiOPLpVwEPO/kLucnYFER+NY/8XaBh0Gu73Zr6DZ3TD93+5w+4rmsS/nL+dFxKip86595LGEXf/F2a/Bj+NOwce7jhw3jsoedA9fWhVdRF3g0GA5yqHbACvwhWaS8wK8TgQjrEnprZBBXR34DnSWUMsBM4ajFAsTisDC5tDE24iDclwW5mGQIWELth7LX1EwNPmhluVerGxvNC43GtRvf+/TTjQq80Wi0fgp7COks5Dad/5w7tsGtqH47tvy72t/2220WSeAk2KFYZZGn6CeB1HG+qjnUOtGI060560jNZbhddcSsOkbMdaTt8Xs9deS6L+j31bPppBmLhKVgIBCc3fojGDiVSSXi0b6QFAgGjqJjn0O3Po1OfQpd+kTvqmd75P8FfHkvUBjAQMG97V7n3iz8kvx5c9zd24POHc49D7Oi3KtYn7qn/nnPnm5/qp0BNFDZnjaqG9vy9gSXKi2lytgIrKB/Ta+jj+2rBX2aleMpgXFmLcg6Bu70Md2ne1mkXixUIZ0qMIFGqfagdKNzEeODGOzGU4GbNwOFw4FbN/0TOf/Nm/7chP/mLf9E/kwiwOqc/9Yt9u7WzUCnP4+fle6TIx+JkQG6+yeZdIKzyDDewfbHJeAQJHLWNQ2sCrEu20GRibLsANViE9QVFmLaULOpYKHCKtsSh2LlRJ9qUVnEKPC8MEsEgemxgArfweFjW1TtisZZZaTrUNEiIq2VB9KyPZiW9qWskFmw6QdTlVfbZC2qbe3/T9eNdGfuoaus/tqEa7NfiKbFRle/MNEFlmpmwI/ql+3fkUqa8b6wPxZgob5P8/VU0yWEsm6Gc/OaiXU/YC304vA0i9XjKLTevFHOS14zbZgVBmXZvWYH0lYqzX+Np9MH0+nY0J49S3v3vh15bMfFp/rXIqhObRd0FPVlMXcqh4+/9kQNH35p6fzTTz7Z0R/0S29xNvIsOV6bXJgrcKLgRWsrs3uvcRntq0QFkRfY9QZQEZasQFHj5rCiZJ5jajb19FMX1ldXlhbnT544fnTs6559SzbUNyGeiotmPFUuVGi5tA8KaYYTHKCj38t5vLoodQcU2wOKaa1cShUGYRekd4GI00rlHB5CPoemTIyLkmh4GcDokNpFi/f3u7dIcz/wP5J7xG93gisQtbhAMlrf8UhgWOJ9OiiOwOO76z676vL0YR86GcpTWZDjPg8oauDxoSWPqroCIasOkgNeUCVwW3eFVNX36OCST1V1X1zSwW2JhlygnOB5n93lpKJoO/hvisBx/35CEXmnS/UB69GcPC/ZD0bgHxx2FQlanVTgabc7wLoF5fgtim7z+nFFpIpnW4f9WPO/DiAxDDR9HT7Rt5FPWbKrlg3LFHk0joePDFhhuOFJBjH4OcLz7IKSJ1P78u5hUxD8WcDjQefODkjTxSywe1tzq5VK44+dZYldXdK3dTVEVR489lFVn3Y5sZwtH04mlg9WfgA2Vacf9zsTwKliX3ND1XWVvtKcZzUYUiB2cP/0w99Cl9e9Vz3PrWIMxPzqeG2MR3FxOO2cIBKhripUREslyQhN2eKVCSvIsl0+QghzYDhny4dpWwldGBTNsim1s5Fv53y5nfE9vs5zq9ciG5EG5o/eifxwW/taI9KAjzYamDYa3arRYOb77t3u/9sYKh8hz9ccJvBCFkWdWAAkDm24gjZnAFWaE/gVBmBEjrQv+xB0otIL8jyRZWUC4Rl6AkrtFAOtnZ3h3NoXGr9QU4qxlO4ulrymBbcpbIPUXgSi7u59e1pDQ4BcQiPAbuRxhNSFrKhl2Mc4yG0qYnNTtlpluihZJwrJ5mayAKUEXUwWPpywys3OvfiZM4kSFJL4trSPLrLhnQ66wsZ3OqDwozNn2qMZwYkOjQL5XxyYz4kAAHicY2BkYGAA4nwdO954fpuvDNzML4AiDNd9pKbB6P///2cxv2AOAnI5GJhAogAu1AvVAAB4nGNgZGBgDvqfBSRf/AcC5hcMQBEUIAwAtq0HpgAAAHicY37BwMAMwgugNC4ciWAzrUNinwLS2SD2//8Ae2MRwgAAAAAAAAABygK4AxQDhgSMBuIH6giCCOwJcAmyCpgK1gw4DQwNZA24DlIAAQAAABMAiAAWAAAAAAACAI4AngBzAAABWwtwAAAAAHicdZDfSgJBFMa/yT+VQkVBt81VKOH6BwIRBMHQm7qR8DbWdf/JuiOzo+Br9A49TC/Rs/S5jhFGu8zO73znO2fODoBrfEFg/zxy7VngjNGeT3CKvuUC9SfLRfKz5RKqeLVcpv5muYIHhJaruME7O4jiOaMFPiwLXIlLyye4EHeWC9QblovkvuUSbsWL5TJ1z3IFU5FZruJefA7VaqvjMDKyNqzLTqvdlbOtVJTi1E2kuzaR0pkcyEClxk8S5XhqGcwasafSbOKH68TVh/CwT32dxSqVbad1kMZ+6mvX+PNd92wTdowJZKDVUo5sX7nSauF7xomMWfWazd/nYQiFFbbQiHlVEQwkalTr3DtooY0uaUaHpHPvipHCRULFxZoVUZ7JGA+4AkYpVZ+OhOzA43dJfYYGa708n2FCR8j6hF30n+xxPKV7d0acx5JzOZzu2DWmK82dbj7B/Gf2DBue1qFqWLWbUudTSYyO5pW8j11uQcWj7uS3Yqj20OT7z/99A+gqgcN4nG3IWw7CIBBGYX5FbK133YaLmg6jECkQpInu3mjjm+fpy1EzNbVS/zthhjk0FjBYokGLFTqsscEWO+xxwBEnnNWaxpo4DTlIFW2pSsNO+N6n5/aHy62kMXeFrE+T2+LZXao8q3lIEK7Nx1SE9HdmieyDvvogxnlrJRqmyBJMP9aaonFCVkqbqdCtUHYmjkMvRXPKL6Xep1o2rQB4nGPw3sFwIihiIyNjX+QGxp0cDBwMyQUbGVidNjEwMmiBGJu5mBg5ICw+BjCLzWkX0wGgNCeQze60i8EBwmZmcNmowtgRGLHBoSNiI3OKy0Y1EG8XRwMDI4tDR3JIBEhJJBBs5mFi5NHawfi/dQNL70YmBhcADHYj9AAA\") format(\"woff\")}[class^=\"icon-\"]:before,[class*=\" icon-\"]:before{font-family:\"fb-icons\";font-style:normal;font-weight:normal;speak:none;display:inline-block;text-decoration:inherit;width:1em;margin-right:.2em;text-align:center;font-variant:normal;text-transform:none;line-height:1em;margin-left:.2em}.icon-autocomplete:before{content:'\\e800'}.icon-date:before{content:'\\e801'}.icon-checkbox:before{content:'\\e802'}.icon-checkbox-group:before{content:'\\e803'}.icon-radio-group:before{content:'\\e804'}.icon-rich-text:before{content:'\\e805'}.icon-select:before{content:'\\e806'}.icon-textarea:before{content:'\\e807'}.icon-text:before{content:'\\e808'}.icon-pencil:before{content:'\\e809'}.icon-file:before{content:'\\e80a'}.icon-hidden:before{content:'\\e80b'}.icon-cancel:before{content:'\\e80c'}.icon-button:before{content:'\\e80d'}.icon-header:before{content:'\\e80f'}.icon-paragraph:before{content:'\\e810'}.icon-number:before{content:'\\e811'}.icon-copy:before{content:'\\f24d'}.form-wrap.form-builder{position:relative}.form-wrap.form-builder *{box-sizing:border-box}.form-wrap.form-builder button,.form-wrap.form-builder input,.form-wrap.form-builder select,.form-wrap.form-builder textarea{font-family:inherit;font-size:inherit;line-height:inherit}.form-wrap.form-builder input{line-height:normal}.form-wrap.form-builder textarea{overflow:auto}.form-wrap.form-builder button,.form-wrap.form-builder input,.form-wrap.form-builder select,.form-wrap.form-builder textarea{font-family:inherit;font-size:inherit;line-height:inherit}.form-wrap.form-builder .btn-group{position:relative;display:inline-block;vertical-align:middle}.form-wrap.form-builder .btn-group>.btn{position:relative;float:left}.form-wrap.form-builder .btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle){border-top-right-radius:0;border-bottom-right-radius:0}.form-wrap.form-builder .btn-group>.btn:not(:first-child):not(:last-child):not(.dropdown-toggle){border-radius:0}.form-wrap.form-builder .btn-group .btn+.btn,.form-wrap.form-builder .btn-group .btn+.btn-group,.form-wrap.form-builder .btn-group .btn-group+.btn,.form-wrap.form-builder .btn-group .btn-group+.btn-group{margin-left:-1px}.form-wrap.form-builder .btn-group>.btn:last-child:not(:first-child),.form-wrap.form-builder .btn-group>.dropdown-toggle:not(:first-child),.form-wrap.form-builder .btn-group .input-group .form-control:last-child,.form-wrap.form-builder .btn-group .input-group-addon:last-child,.form-wrap.form-builder .btn-group .input-group-btn:first-child>.btn-group:not(:first-child)>.btn,.form-wrap.form-builder .btn-group .input-group-btn:first-child>.btn:not(:first-child),.form-wrap.form-builder .btn-group .input-group-btn:last-child>.btn,.form-wrap.form-builder .btn-group .input-group-btn:last-child>.btn-group>.btn,.form-wrap.form-builder .btn-group .input-group-btn:last-child>.dropdown-toggle{border-top-left-radius:0;border-bottom-left-radius:0}.form-wrap.form-builder .btn-group>.btn.active,.form-wrap.form-builder .btn-group>.btn:active,.form-wrap.form-builder .btn-group>.btn:focus,.form-wrap.form-builder .btn-group>.btn:hover{z-index:2}.form-wrap.form-builder .btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border-radius:4px}.form-wrap.form-builder .btn.btn-lg{padding:10px 16px;font-size:18px;line-height:1.3333333;border-radius:6px}.form-wrap.form-builder .btn.btn-sm{padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px}.form-wrap.form-builder .btn.btn-xs{padding:1px 5px;font-size:12px;line-height:1.5;border-radius:3px}.form-wrap.form-builder .btn.active,.form-wrap.form-builder .btn.btn-active,.form-wrap.form-builder .btn:active{background-image:none}.form-wrap.form-builder .input-group .form-control:last-child,.form-wrap.form-builder .input-group-addon:last-child,.form-wrap.form-builder .input-group-btn:first-child>.btn-group:not(:first-child)>.btn,.form-wrap.form-builder .input-group-btn:first-child>.btn:not(:first-child),.form-wrap.form-builder .input-group-btn:last-child>.btn,.form-wrap.form-builder .input-group-btn:last-child>.btn-group>.btn,.form-wrap.form-builder .input-group-btn:last-child>.dropdown-toggle{border-top-left-radius:0;border-bottom-left-radius:0}.form-wrap.form-builder .input-group .form-control,.form-wrap.form-builder .input-group-addon,.form-wrap.form-builder .input-group-btn{display:table-cell}.form-wrap.form-builder .input-group-lg>.form-control,.form-wrap.form-builder .input-group-lg>.input-group-addon,.form-wrap.form-builder .input-group-lg>.input-group-btn>.btn{height:46px;padding:10px 16px;font-size:18px;line-height:1.3333333}.form-wrap.form-builder .input-group{position:relative;display:table;border-collapse:separate}.form-wrap.form-builder .input-group .form-control{position:relative;z-index:2;float:left;width:100%;margin-bottom:0}.form-wrap.form-builder .form-control,.form-wrap.form-builder output{font-size:14px;line-height:1.42857143;display:block}.form-wrap.form-builder textarea.form-control{height:auto}.form-wrap.form-builder .form-control{height:34px;display:block;width:100%;padding:6px 12px;font-size:14px;line-height:1.42857143;border-radius:4px}.form-wrap.form-builder .form-control:focus{outline:0;box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(102,175,233,0.6)}.form-wrap.form-builder .form-group{margin-left:0px;margin-bottom:15px}.form-wrap.form-builder .btn,.form-wrap.form-builder .form-control{background-image:none}.form-wrap.form-builder .pull-right{float:right}.form-wrap.form-builder .pull-left{float:left}.form-wrap.form-builder .fb-required,.form-wrap.form-builder .required-asterisk{color:#c10000}.form-wrap.form-builder .fb-checkbox-group input[type='checkbox'],.form-wrap.form-builder .fb-checkbox-group input[type='radio'],.form-wrap.form-builder .fb-radio-group input[type='checkbox'],.form-wrap.form-builder .fb-radio-group input[type='radio']{margin:0 4px 0 0}.form-wrap.form-builder .fb-checkbox-inline,.form-wrap.form-builder .fb-radio-inline{margin-right:8px;display:inline-block;vertical-align:middle;padding-left:0}.form-wrap.form-builder .fb-checkbox-inline label input[type='text'],.form-wrap.form-builder .fb-radio-inline label input[type='text']{margin-top:0}.form-wrap.form-builder .fb-checkbox-inline:first-child,.form-wrap.form-builder .fb-radio-inline:first-child{padding-left:0}.form-wrap.form-builder .fb-autocomplete-list{background-color:#fff;display:none;list-style:none;padding:0;border:1px solid #ccc;border-width:0 1px 1px;position:absolute;z-index:20;max-height:200px;overflow-y:auto}.form-wrap.form-builder .fb-autocomplete-list li{display:none;cursor:default;padding:5px;margin:0;transition:background-color 200ms ease-in-out}.form-wrap.form-builder .fb-autocomplete-list li:hover,.form-wrap.form-builder .fb-autocomplete-list li.active-option{background-color:rgba(0,0,0,0.075)}@keyframes PLACEHOLDER{0%{height:1px}100%{height:15px}}.form-wrap.form-builder .cb-wrap{width:26%;transition:transform 250ms}.form-wrap.form-builder .cb-wrap.pull-left .form-actions{float:left}.form-wrap.form-builder .cb-wrap h4{margin-top:0;color:#666}@media (max-width: 481px){.form-wrap.form-builder .cb-wrap{width:64px}.form-wrap.form-builder .cb-wrap h4{display:none}}.form-wrap.form-builder .frmb-control{margin:0;padding:0;border-radius:5px}.form-wrap.form-builder .frmb-control li{cursor:move;list-style:none;margin:0 0 -1px 0;padding:10px;text-align:left;background:#fff;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;box-shadow:inset 0 0 0 1px #c5c5c5}.form-wrap.form-builder .frmb-control li .control-icon{width:16px;height:auto;margin-right:10px;margin-left:0.2em;display:inline-block}.form-wrap.form-builder .frmb-control li .control-icon img,.form-wrap.form-builder .frmb-control li .control-icon svg{max-width:100%;height:auto}.form-wrap.form-builder .frmb-control li:first-child{border-radius:5px 5px 0 0;margin-top:0}.form-wrap.form-builder .frmb-control li:last-child{border-radius:0 0 5px 5px}.form-wrap.form-builder .frmb-control li::before{margin-right:10px;font-size:16px}.form-wrap.form-builder .frmb-control li:hover{background-color:#f2f2f2}.form-wrap.form-builder .frmb-control li.ui-sortable-helper{border-radius:5px;transition:box-shadow 250ms;box-shadow:2px 2px 6px 0 #666;border:1px solid #fff}.form-wrap.form-builder .frmb-control li.ui-state-highlight{width:0;overflow:hidden;padding:0;margin:0;border:0 none}.form-wrap.form-builder .frmb-control li.moving{opacity:.6}.form-wrap.form-builder .frmb-control li.fb-separator{background-color:transparent;box-shadow:none;padding:0;cursor:default}.form-wrap.form-builder .frmb-control li.fb-separator hr{margin:10px 0}@media (max-width: 481px){.form-wrap.form-builder .frmb-control li::before{font-size:30px}.form-wrap.form-builder .frmb-control li span{display:none}}.form-wrap.form-builder .frmb-control.sort-enabled li.ui-state-highlight{box-shadow:none;height:0;width:100%;background:radial-gradient(ellipse at center, #545454 0%, rgba(0,0,0,0) 75%);border:0 none;-webkit-clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);visibility:visible;overflow:hidden;margin:1px 0 3px;animation:PLACEHOLDER 250ms forwards}.form-wrap.form-builder .fb-mobile .form-actions{width:100%}.form-wrap.form-builder .fb-mobile .form-actions button{width:100%;font-size:.85em !important;display:block !important;border-radius:0 !important;margin-top:-1px;margin-left:0 !important}.form-wrap.form-builder .fb-mobile .form-actions button:first-child{border-radius:5px 5px 0 0 !important;margin-top:0 !important;border-bottom:0 none}.form-wrap.form-builder .fb-mobile .form-actions button:last-child{border-radius:0 0 5px 5px !important}.form-wrap.form-builder .form-actions{float:right;margin-top:5px}.form-wrap.form-builder .form-actions button{border:0 none}.form-wrap.form-builder .stage-wrap{position:relative;padding:0;margin:0;width:calc(74% - 5px)}@media (max-width: 481px){.form-wrap.form-builder .stage-wrap{width:calc(100% - 64px)}}.form-wrap.form-builder .stage-wrap.empty{border:3px dashed #ccc;background-color:rgba(255,255,255,0.25)}.form-wrap.form-builder .stage-wrap.empty::after{content:attr(data-content);position:absolute;text-align:center;top:50%;left:0;width:100%;margin-top:-1em}.form-wrap.form-builder .frmb{list-style-type:none;min-height:200px;transition:background-color 500ms ease-in-out}.form-wrap.form-builder .frmb .fb-required{color:#c10000}.form-wrap.form-builder .frmb.removing{overflow:hidden}.form-wrap.form-builder .frmb>li:hover{border-color:#66afe9;outline:0;box-shadow:inset 0 1px 1px rgba(0,0,0,0.1),0 0 8px rgba(102,175,233,0.6)}.form-wrap.form-builder .frmb>li:hover .field-actions{opacity:1}.form-wrap.form-builder .frmb>li:hover li :hover{background:#fefefe}.form-wrap.form-builder .frmb li{position:relative;padding:6px;clear:both;margin-left:0;margin-bottom:3px;background-color:#fff;transition:background-color 250ms ease-in-out, margin-top 400ms}.form-wrap.form-builder .frmb li.hidden-field{background-color:rgba(255,255,255,0.6)}.form-wrap.form-builder .frmb li:first-child{border-top-right-radius:5px;border-top-left-radius:5px}.form-wrap.form-builder .frmb li:first-child .field-actions .btn:last-child{border-radius:0 5px 0 0}.form-wrap.form-builder .frmb li:last-child{border-bottom-right-radius:5px;border-bottom-left-radius:5px}.form-wrap.form-builder .frmb li.no-fields label{font-weight:400}@keyframes PLACEHOLDER{0%{height:0}100%{height:15px}}.form-wrap.form-builder .frmb li.frmb-placeholder,.form-wrap.form-builder .frmb li.ui-state-highlight{height:0;padding:0;background:radial-gradient(ellipse at center, #545454 0%, rgba(0,0,0,0) 75%);border:0 none;-webkit-clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);visibility:visible;overflow:hidden;margin-bottom:3px;animation:PLACEHOLDER 250ms forwards}.form-wrap.form-builder .frmb li.moving,.form-wrap.form-builder .frmb li.ui-sortable-helper{transition:box-shadow 500ms ease-in-out;box-shadow:2px 2px 6px 0 #666;border:1px solid #fff;border-radius:5px}.form-wrap.form-builder .frmb li.disabled-field{z-index:1;position:relative;overflow:visible}.form-wrap.form-builder .frmb li.disabled-field:hover .frmb-tt{display:inline-block}.form-wrap.form-builder .frmb li.disabled-field [type='checkbox']{float:left;margin-right:10px}.form-wrap.form-builder .frmb li.disabled-field h2{border-bottom:0 none}.form-wrap.form-builder .frmb li.disabled-field label{font-size:12px;font-weight:400;color:#666}.form-wrap.form-builder .frmb li.disabled-field .prev-holder{cursor:default;line-height:28px;padding-left:5px}.form-wrap.form-builder .frmb li .close-field{position:absolute;color:#666;left:50%;bottom:6px;background:#fff;border-top:1px solid #c5c5c5;border-left:1px solid #c5c5c5;border-right:1px solid #c5c5c5;transform:translateX(-50%);padding:0 5px;border-top-right-radius:3px;border-top-left-radius:3px;cursor:pointer;transition:background-color 250ms ease-in-out}.form-wrap.form-builder .frmb li .close-field:hover{text-decoration:none}.form-wrap.form-builder .frmb li.button-field h1,.form-wrap.form-builder .frmb li.button-field h2,.form-wrap.form-builder .frmb li.button-field h3,.form-wrap.form-builder .frmb li.button-field p,.form-wrap.form-builder .frmb li.button-field canvas,.form-wrap.form-builder .frmb li.button-field output,.form-wrap.form-builder .frmb li.button-field address,.form-wrap.form-builder .frmb li.button-field blockquote,.form-wrap.form-builder .frmb li.button-field .prev-holder,.form-wrap.form-builder .frmb li.header-field h1,.form-wrap.form-builder .frmb li.header-field h2,.form-wrap.form-builder .frmb li.header-field h3,.form-wrap.form-builder .frmb li.header-field p,.form-wrap.form-builder .frmb li.header-field canvas,.form-wrap.form-builder .frmb li.header-field output,.form-wrap.form-builder .frmb li.header-field address,.form-wrap.form-builder .frmb li.header-field blockquote,.form-wrap.form-builder .frmb li.header-field .prev-holder,.form-wrap.form-builder .frmb li.paragraph-field h1,.form-wrap.form-builder .frmb li.paragraph-field h2,.form-wrap.form-builder .frmb li.paragraph-field h3,.form-wrap.form-builder .frmb li.paragraph-field p,.form-wrap.form-builder .frmb li.paragraph-field canvas,.form-wrap.form-builder .frmb li.paragraph-field output,.form-wrap.form-builder .frmb li.paragraph-field address,.form-wrap.form-builder .frmb li.paragraph-field blockquote,.form-wrap.form-builder .frmb li.paragraph-field .prev-holder{margin:0}.form-wrap.form-builder .frmb li.button-field .field-label,.form-wrap.form-builder .frmb li.header-field .field-label,.form-wrap.form-builder .frmb li.paragraph-field .field-label{display:none}.form-wrap.form-builder .frmb li.button-field.editing .field-label,.form-wrap.form-builder .frmb li.header-field.editing .field-label,.form-wrap.form-builder .frmb li.paragraph-field.editing .field-label{display:block}.form-wrap.form-builder .frmb li.paragraph-field .fld-label{min-height:150px;overflow-y:auto}.form-wrap.form-builder .frmb li.checkbox-field .field-label{display:none}.form-wrap.form-builder .frmb li.deleting,.form-wrap.form-builder .frmb li.delete:hover,.form-wrap.form-builder .frmb li:hover li.delete:hover{background-color:#fdd}.form-wrap.form-builder .frmb li.deleting .close-field,.form-wrap.form-builder .frmb li.delete:hover .close-field,.form-wrap.form-builder .frmb li:hover li.delete:hover .close-field{background-color:#fdd}.form-wrap.form-builder .frmb li.deleting{z-index:20;pointer-events:none}.form-wrap.form-builder .frmb.disabled-field{padding:0 5px}.form-wrap.form-builder .frmb.disabled-field :hover{border-color:transparent}.form-wrap.form-builder .frmb.disabled-field .form-element{float:none;margin-bottom:10px;overflow:visible;padding:5px 0;position:relative}.form-wrap.form-builder .frmb .frm-holder{display:none}.form-wrap.form-builder .frmb .tooltip{left:20px}.form-wrap.form-builder .frmb .prev-holder{display:block}.form-wrap.form-builder .frmb .prev-holder .form-group{margin:0}.form-wrap.form-builder .frmb .prev-holder .ql-editor{min-height:125px}.form-wrap.form-builder .frmb .prev-holder .form-group>label:not([class='fb-checkbox-label']){display:none}.form-wrap.form-builder .frmb .prev-holder select,.form-wrap.form-builder .frmb .prev-holder input[type='text'],.form-wrap.form-builder .frmb .prev-holder textarea,.form-wrap.form-builder .frmb .prev-holder input[type='number']{background-color:#fff;border:1px solid #ccc;box-shadow:inset 0 1px 1px rgba(0,0,0,0.075)}.form-wrap.form-builder .frmb .prev-holder input[type='color']{width:60px;padding:2px;display:inline-block}.form-wrap.form-builder .frmb .prev-holder input[type='date']{width:auto}.form-wrap.form-builder .frmb .prev-holder select[multiple]{height:auto}.form-wrap.form-builder .frmb .prev-holder label{font-weight:normal}.form-wrap.form-builder .frmb .prev-holder input[type='number']{width:auto}.form-wrap.form-builder .frmb .prev-holder input[type='color']{width:60px;padding:2px;display:inline-block}.form-wrap.form-builder .frmb .required-asterisk{display:none}.form-wrap.form-builder .frmb .field-label,.form-wrap.form-builder .frmb .legend{color:#666;margin-bottom:5px;line-height:27px;font-size:16px;font-weight:normal}.form-wrap.form-builder .frmb .disabled-field .field-label{display:block}.form-wrap.form-builder .frmb .other-option:checked+label input{display:inline-block}.form-wrap.form-builder .frmb .other-val{margin-left:5px;display:none}.form-wrap.form-builder .frmb .field-actions{position:absolute;top:0;right:0;opacity:0}.form-wrap.form-builder .frmb .field-actions a::before{margin:0}.form-wrap.form-builder .frmb .field-actions a:hover{text-decoration:none;color:#000}.form-wrap.form-builder .frmb .field-actions .btn{display:inline-block;width:32px;height:32px;padding:0 6px;border-radius:0;border-color:#c5c5c5;background-color:#fff;color:#c5c5c5;line-height:32px;font-size:16px;border-width:0 0 1px 1px}.form-wrap.form-builder .frmb .field-actions .btn:first-child{border-bottom-left-radius:5px}.form-wrap.form-builder .frmb .field-actions .toggle-form:hover{background-color:#65aac6;color:#fff}.form-wrap.form-builder .frmb .field-actions .copy-button:hover{background-color:#6fc665;color:#fff}.form-wrap.form-builder .frmb .field-actions .del-button:hover{background-color:#c66865;color:#fff}.form-wrap.form-builder .frmb .option-actions{text-align:right;margin-top:10px;width:100%;margin-left:2%}.form-wrap.form-builder .frmb .option-actions button,.form-wrap.form-builder .frmb .option-actions a{background:#fff;padding:5px 10px;border:1px solid #c5c5c5;font-size:14px;border-radius:5px;cursor:default}.form-wrap.form-builder .frmb .sortable-options-wrap{width:81.33333333%;display:inline-block}.form-wrap.form-builder .frmb .sortable-options-wrap label{font-weight:normal}@media (max-width: 481px){.form-wrap.form-builder .frmb .sortable-options-wrap{display:block;width:100%}}.form-wrap.form-builder .frmb .sortable-options{display:inline-block;width:100%;margin-left:2%;background:#c5c5c5;margin-bottom:0;border-radius:5px;list-style:none;padding:0}.form-wrap.form-builder .frmb .sortable-options>li{cursor:move;margin:1px}.form-wrap.form-builder .frmb .sortable-options>li:nth-child(1) .remove{display:none}.radio-group-field .form-wrap.form-builder .frmb .sortable-options>li:nth-child(2) .remove{display:none}.form-wrap.form-builder .frmb .sortable-options>li .remove{position:absolute;opacity:1;right:14px;height:18px;width:18px;top:14px;font-size:12px;padding:0;color:#c10000}.form-wrap.form-builder .frmb .sortable-options>li .remove::before{margin:0}.form-wrap.form-builder .frmb .sortable-options>li .remove:hover{background-color:#c10000;text-decoration:none;color:#fff}.form-wrap.form-builder .frmb .sortable-options .option-selected{margin:0;width:5%}.form-wrap.form-builder .frmb .sortable-options input[type='text']{width:calc(44.5% - 17px);margin:0 1%;float:none}.form-wrap.form-builder .frmb .form-field .form-group{width:100%;clear:left;float:none}.form-wrap.form-builder .frmb .col-md-6 .form-elements,.form-wrap.form-builder .frmb .col-md-8 .form-elements{width:100%}.form-wrap.form-builder .frmb .field-options .add-area .add{clear:both}.form-wrap.form-builder .frmb .style-wrap button.selected{border:1px solid #000;margin-top:0;margin-right:1px;box-shadow:0 0 0 1px #fff inset;padding:1px 5px}.form-wrap.form-builder .frmb .form-elements{padding:10px 5px;background:#f7f7f7;border-radius:3px;margin:0;border:1px solid #c5c5c5}.form-wrap.form-builder .frmb .form-elements .input-wrap{width:81.33333333%;margin-left:2%;float:left}.form-wrap.form-builder .frmb .form-elements .input-wrap>input[type='checkbox']{margin-top:8px}.form-wrap.form-builder .frmb .form-elements .btn-group{margin-left:2%}.form-wrap.form-builder .frmb .form-elements .add{clear:both}.form-wrap.form-builder .frmb .form-elements [contenteditable],.form-wrap.form-builder .frmb .form-elements select[multiple]{height:auto}.form-wrap.form-builder .frmb .form-elements [contenteditable].form-control,.form-wrap.form-builder .frmb .form-elements input[type='text'],.form-wrap.form-builder .frmb .form-elements input[type='number'],.form-wrap.form-builder .frmb .form-elements input[type='date'],.form-wrap.form-builder .frmb .form-elements input[type='color'],.form-wrap.form-builder .frmb .form-elements textarea,.form-wrap.form-builder .frmb .form-elements select{transition:background 250ms ease-in-out;padding:6px 12px;border:1px solid #c5c5c5;background-color:#fff}@media (max-width: 481px){.form-wrap.form-builder .frmb .form-elements .input-wrap{width:100%;margin-left:0;float:none}}.form-wrap.form-builder .frmb .form-elements input[type='number']{width:auto}.form-wrap.form-builder .frmb .form-elements .btn-group{margin-left:2%}.col-md-6 .form-wrap.form-builder .frmb .form-elements .false-label,.col-md-8 .form-wrap.form-builder .frmb .form-elements .false-label,.col-md-6 .form-wrap.form-builder .frmb .form-elements label,.col-md-8 .form-wrap.form-builder .frmb .form-elements label{display:block}.form-wrap.form-builder .frmb .form-elements .false-label:first-child,.form-wrap.form-builder .frmb .form-elements label:first-child{width:16.66666667%;padding-top:7px;margin-bottom:0;text-align:right;font-weight:700;float:left;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;text-transform:capitalize}@media (max-width: 481px){.form-wrap.form-builder .frmb .form-elements .false-label:first-child,.form-wrap.form-builder .frmb .form-elements label:first-child{display:block;width:auto;float:none;text-align:left}.form-wrap.form-builder .frmb .form-elements .false-label:first-child.empty-label,.form-wrap.form-builder .frmb .form-elements label:first-child.empty-label{display:none}}.form-wrap.form-builder .frmb .form-elements .false-label.multiple,.form-wrap.form-builder .frmb .form-elements .false-label.required-label,.form-wrap.form-builder .frmb .form-elements .false-label.toggle-label,.form-wrap.form-builder .frmb .form-elements .false-label.roles-label,.form-wrap.form-builder .frmb .form-elements .false-label.other-label,.form-wrap.form-builder .frmb .form-elements label.multiple,.form-wrap.form-builder .frmb .form-elements label.required-label,.form-wrap.form-builder .frmb .form-elements label.toggle-label,.form-wrap.form-builder .frmb .form-elements label.roles-label,.form-wrap.form-builder .frmb .form-elements label.other-label{text-align:left;float:none;margin-bottom:-3px;font-weight:400;width:calc(81.3333% - 23px)}.form-wrap.form-builder .frmb .form-elements input.error{border:1px solid #c10000}.form-wrap.form-builder .frmb .form-elements input.fld-maxlength{width:75px}.form-wrap.form-builder .frmb .form-elements input.field-error{background:#fefefe;border:1px solid #c5c5c5}.form-wrap.form-builder .frmb .form-elements label em{display:block;font-weight:400;font-size:0.75em}.form-wrap.form-builder .frmb .form-elements label.maxlength-label{line-height:1em}.form-wrap.form-builder .frmb .form-elements .available-roles{display:none;padding:10px;margin:10px 0;background:#e6e6e6;box-shadow:inset 0 0 2px 0 #b3b3b3}@media (max-width: 481px){.form-wrap.form-builder .frmb .form-elements .available-roles{margin-left:0}}.form-wrap.form-builder .frmb .form-elements .available-roles label{font-weight:400;width:auto;float:none;display:inline}.form-wrap.form-builder .frmb .form-elements .available-roles input{display:inline;top:auto}.form-wrap.form-builder .autocomplete-field .sortable-options .option-selected{display:none}.form-wrap.form-builder .fb-mobile .field-actions{opacity:1}.form-wrap.form-builder *[tooltip]{position:relative}.form-wrap.form-builder *[tooltip]:hover:after{background:rgba(0,0,0,0.9);border-radius:5px 5px 5px 0;bottom:23px;color:#fff;content:attr(tooltip);padding:10px 5px;position:absolute;z-index:98;left:2px;width:230px;text-shadow:none;font-size:12px;line-height:1.5em;cursor:default}.form-wrap.form-builder *[tooltip]:hover:before{border:solid;border-color:#222 transparent;border-width:6px 6px 0;bottom:17px;content:'';left:2px;position:absolute;z-index:99;cursor:default}.form-wrap.form-builder .tooltip-element{visibility:visible;color:#fff;background:#000;width:16px;height:16px;border-radius:8px;display:inline-block;text-align:center;line-height:16px;margin:0 5px;font-size:12px;cursor:default}.form-wrap.form-builder .kc-toggle{padding-left:0 !important}.form-wrap.form-builder .kc-toggle span{position:relative;width:48px;height:24px;background:#e6e6e6;display:inline-block;border-radius:4px;border:1px solid #ccc;padding:2px;overflow:hidden;float:left;margin-right:5px;will-change:transform}.form-wrap.form-builder .kc-toggle span::after,.form-wrap.form-builder .kc-toggle span::before{position:absolute;display:inline-block;top:0}.form-wrap.form-builder .kc-toggle span::after{position:relative;content:'';width:50%;height:100%;left:0;border-radius:3px;background:linear-gradient(to bottom, #fff 0%, #ccc 100%);border:1px solid #999;transition:transform 100ms;transform:translateX(0)}.form-wrap.form-builder .kc-toggle span::before{border-radius:4px;top:2px;left:2px;content:'';width:calc(100% - 4px);height:18px;box-shadow:0 0 1px 1px #b3b3b3 inset;background-color:transparent}.form-wrap.form-builder .kc-toggle input{height:0;overflow:hidden;width:0;opacity:0;pointer-events:none;margin:0}.form-wrap.form-builder .kc-toggle input:checked+span::after{transform:translateX(100%)}.form-wrap.form-builder .kc-toggle input:checked+span::before{background-color:#6fc665}.form-wrap.form-builder::after{content:'';display:table;clear:both}.cb-wrap,.stage-wrap{vertical-align:top}.cb-wrap.pull-right,.stage-wrap.pull-right{float:right}.cb-wrap.pull-left,.stage-wrap.pull-left{float:left}.form-elements,.form-group,.multi-row span,textarea{display:block}.form-elements::after,.form-group::after{content:'.';display:block;height:0;clear:both;visibility:hidden}.form-elements .field-options div:hover,.frmb .legend,.frmb .prev-holder{cursor:move}.frmb-tt{display:none;position:absolute;top:0;left:0;border:1px solid #262626;background-color:#666;border-radius:5px;padding:5px;color:#fff;z-index:20;text-align:left;font-size:12px;pointer-events:none}.frmb-tt::before{border-color:#262626 transparent;bottom:-11px}.frmb-tt::before,.frmb-tt::after{content:'';position:absolute;border-style:solid;border-width:10px 10px 0;border-color:#666 transparent;display:block;width:0;z-index:1;margin-left:-10px;bottom:-10px;left:20px}.frmb-tt a{text-decoration:underline;color:#fff}.frmb li:hover .del-button,.frmb li:hover .toggle-form,.fb-mobile .frmb li .del-button,.fb-mobile .frmb li .toggle-form{opacity:1}.frmb-xml .ui-dialog-content{white-space:pre-wrap;word-wrap:break-word;font-size:12px;padding:0 30px;margin-top:0}.toggle-form{opacity:0}.toggle-form:hover{border-color:#ccc}.toggle-form::before{margin:0}.formb-field-vars .copy-var{display:inline-block;width:24px;height:24px;background:#b3b3b3;text-indent:-9999px}.ui-button .ui-button-text{line-height:0}.form-builder-overlay{position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,0.5);display:none;z-index:10}.form-builder-overlay.visible{display:block}.form-builder-dialog{position:absolute;border-radius:5px;background:#fff;z-index:20;transform:translate(-50%, -50%);top:0;left:0;padding:10px;box-shadow:0 3px 10px #000;min-width:166px;max-height:80%;overflow-y:scroll}.form-builder-dialog h3{margin-top:0}.form-builder-dialog.data-dialog{width:65%;background-color:#23241f}.form-builder-dialog.data-dialog pre{background:none;border:0 none;box-shadow:none;margin:0;color:#f2f2f2}.form-builder-dialog.positioned{transform:translate(-50%, -100%)}.form-builder-dialog.positioned .button-wrap::before{content:'';width:0;height:0;border-left:15px solid transparent;border-right:15px solid transparent;border-top:10px solid #fff;position:absolute;left:50%;top:100%;transform:translate(-50%, 10px)}.form-builder-dialog .button-wrap{position:relative;margin-top:10px;text-align:right;clear:both}.form-builder-dialog .button-wrap .btn{margin-left:10px}\n", ""])
  }, function(e, t, r) {
      var n = r(11),
          o = r(19),
          i = r(22),
          a = "Expected a function",
          l = Math.max,
          s = Math.min;
      e.exports = function(e, t, r) {
          var u, f, c, d, p, m, b = 0,
              h = !1,
              g = !1,
              v = !0;
          if ("function" != typeof e) throw new TypeError(a);

          function y(t) {
              var r = u,
                  n = f;
              return u = f = void 0, b = t, d = e.apply(n, r)
          }

          function w(e) {
              var r = e - m;
              return void 0 === m || r >= t || r < 0 || g && e - b >= c
          }

          function x() {
              var e = o();
              if (w(e)) return A(e);
              p = setTimeout(x, function(e) {
                  var r = t - (e - m);
                  return g ? s(r, c - (e - b)) : r
              }(e))
          }

          function A(e) {
              return p = void 0, v && u ? y(e) : (u = f = void 0, d)
          }

          function O() {
              var e = o(),
                  r = w(e);
              if (u = arguments, f = this, m = e, r) {
                  if (void 0 === p) return function(e) {
                      return b = e, p = setTimeout(x, t), h ? y(e) : d
                  }(m);
                  if (g) return p = setTimeout(x, t), y(m)
              }
              return void 0 === p && (p = setTimeout(x, t)), d
          }
          return t = i(t) || 0, n(r) && (h = !!r.leading, c = (g = "maxWait" in r) ? l(i(r.maxWait) || 0, t) : c, v = "trailing" in r ? !!r.trailing : v), O.cancel = function() {
              void 0 !== p && clearTimeout(p), b = 0, u = m = f = p = void 0
          }, O.flush = function() {
              return void 0 === p ? d : A(o())
          }, O
      }
  }, function(e, t, r) {
      var n = r(13);
      e.exports = function() {
          return n.Date.now()
      }
  }, function(e, t, r) {
      (function(t) {
          var r = "object" == typeof t && t && t.Object === Object && t;
          e.exports = r
      }).call(this, r(21))
  }, function(e, t) {
      var r;
      r = function() {
          return this
      }();
      try {
          r = r || new Function("return this")()
      } catch (e) {
          "object" == typeof window && (r = window)
      }
      e.exports = r
  }, function(e, t, r) {
      var n = r(11),
          o = r(23),
          i = NaN,
          a = /^\s+|\s+$/g,
          l = /^[-+]0x[0-9a-f]+$/i,
          s = /^0b[01]+$/i,
          u = /^0o[0-7]+$/i,
          f = parseInt;
      e.exports = function(e) {
          if ("number" == typeof e) return e;
          if (o(e)) return i;
          if (n(e)) {
              var t = "function" == typeof e.valueOf ? e.valueOf() : e;
              e = n(t) ? t + "" : t
          }
          if ("string" != typeof e) return 0 === e ? e : +e;
          e = e.replace(a, "");
          var r = s.test(e);
          return r || u.test(e) ? f(e.slice(2), r ? 2 : 8) : l.test(e) ? i : +e
      }
  }, function(e, t, r) {
      var n = r(24),
          o = r(27),
          i = "[object Symbol]";
      e.exports = function(e) {
          return "symbol" == typeof e || o(e) && n(e) == i
      }
  }, function(e, t, r) {
      var n = r(14),
          o = r(25),
          i = r(26),
          a = "[object Null]",
          l = "[object Undefined]",
          s = n ? n.toStringTag : void 0;
      e.exports = function(e) {
          return null == e ? void 0 === e ? l : a : s && s in Object(e) ? o(e) : i(e)
      }
  }, function(e, t, r) {
      var n = r(14),
          o = Object.prototype,
          i = o.hasOwnProperty,
          a = o.toString,
          l = n ? n.toStringTag : void 0;
      e.exports = function(e) {
          var t = i.call(e, l),
              r = e[l];
          try {
              e[l] = void 0;
              var n = !0
          } catch (e) {}
          var o = a.call(e);
          return n && (t ? e[l] = r : delete e[l]), o
      }
  }, function(e, t) {
      var r = Object.prototype.toString;
      e.exports = function(e) {
          return r.call(e)
      }
  }, function(e, t) {
      e.exports = function(e) {
          return null != e && "object" == typeof e
      }
  }, , , , , , function(t, r, n) {
      n.r(r);
      n(16);
      var o = n(15),
          i = n.n(o),
          a = n(4),
          l = {},
          s = function(e) {
              this.formData = {}, this.formID = e, this.layout = "", l[e] = this
          },
          u = n(2),
          f = n.n(u),
          c = n(5),
          d = n(10),
          p = n(0),
          m = n(3),
          b = n(1),
          h = n(6);

      function g(e, t) {
          if (null == e) return {};
          var r, n, o = {},
              i = Object.keys(e);
          for (n = 0; n < i.length; n++) r = i[n], t.indexOf(r) >= 0 || (o[r] = e[r]);
          return o
      }
      var v = function() {
              function t(e, t, r) {
                  this.data = l[e], this.d = a.d[e], this.doCancel = !1, this.layout = t, this.handleKeyDown = this.handleKeyDown.bind(this), this.formBuilder = r
              }
              var r = t.prototype;
              return r.startMoving = function(e, t) {
                  t.item.show().addClass("moving"), this.doCancel = !0, this.from = t.item.parent()
              }, r.stopMoving = function(t, r) {
                  r.item.removeClass("moving"), this.doCancel && (r.sender && e(r.sender).sortable("cancel"), this.from.sortable("cancel")), this.save(), this.doCancel = !1
              }, r.beforeStop = function(e, t) {
                  var r = m.a.opts,
                      n = this.d.stage.childNodes.length - 1,
                      o = [];
                  this.stopIndex = t.placeholder.index() - 1, !r.sortableControls && t.item.parent().hasClass("frmb-control") && o.push(!0), r.prepend && o.push(0 === this.stopIndex), r.append && o.push(this.stopIndex + 1 === n), this.doCancel = o.some(function(e) {
                      return !0 === e
                  })
              }, r.getTypes = function(t) {
                  var r = {
                          type: t.attr("type")
                      },
                      n = e(".fld-subtype", t).val();
                  return n !== r.type && (r.subtype = n), r
              }, r.fieldOptionData = function(t) {
                  var r = [],
                      n = e(".sortable-options li", t);
                  return n.each(function(t) {
                      var o = e(n[t]),
                          i = e(".option-selected", o).is(":checked"),
                          a = {
                              label: e(".option-label", o).val(),
                              value: e(".option-value", o).val()
                          };
                      i && (a.selected = i), r.push(a)
                  }), r
              }, r.xmlSave = function(e) {
                  var t = this.prepData(e),
                      r = new XMLSerializer,
                      n = ["<fields>"];
                  t.forEach(function(e) {
                      var t = e.values,
                          r = g(e, ["values"]),
                          o = ["<field " + Object(p.A)(r) + ">"];
                      if (a.e.includes(e.type)) {
                          var i = t.map(function(e) {
                              return Object(p.p)("option", e.label, e).outerHTML
                          });
                          o = o.concat(i)
                      }
                      o.push("</field>"), n.push(o)
                  }), n.push("</fields>");
                  var o = Object(p.p)("form-template", Object(p.h)(n).join(""));
                  return r.serializeToString(o)
              }, r.prepData = function(t) {
                  var r = [],
                      n = this.d,
                      o = this;
                  return 0 !== t.childNodes.length && Object(p.i)(t.childNodes, function(t, i) {
                      var a = e(i);
                      if (!a.hasClass("disabled-field")) {
                          var l = o.getTypes(a),
                              s = e(".roles-field:checked", i),
                              u = s.map(function(e) {
                                  return s[e].value
                              }).get();
                          if ((l = Object.assign({}, l, o.getAttrVals(i))).subtype)
                              if ("quill" === l.subtype) {
                                  var f = l.name + "-preview";
                                  if (window.fbEditors.quill[f]) {
                                      var c = window.fbEditors.quill[f].instance.getContents();
                                      l.value = window.JSON.stringify(c.ops)
                                  }
                              } else if ("tinymce" === l.subtype && window.tinymce) {
                              var d = l.name + "-preview";
                              if (window.tinymce.editors[d]) {
                                  var m = window.tinymce.editors[d];
                                  l.value = m.getContent()
                              }
                          }
                          if (u.length && (l.role = u.join(",")), l.className = l.className || l.class, l.className) {
                              var b = /(?:^|\s)btn-(.*?)(?:\s|$)/g.exec(l.className);
                              b && (l.style = b[1])
                          }(l = Object(p.y)(l)).type && l.type.match(n.optionFieldsRegEx) && (l.values = o.fieldOptionData(a)), r.push(l)
                      }
                  }), r
              }, r.getData = function(e) {
                  var t = this.data;
                  if (e || (e = m.a.opts.formData), !e) return !1;
                  var r = {
                      xml: function(e) {
                          return Array.isArray(e) ? e : Object(p.s)(e)
                      },
                      json: function(e) {
                          return "string" == typeof e ? window.JSON.parse(e) : e
                      }
                  };
                  return t.formData = r[m.a.opts.dataType](e) || [], t.formData
              }, r.save = function(e) {
                  var t = this,
                      r = this.data,
                      n = this.d.stage,
                      o = {
                          xml: function(e) {
                              return t.xmlSave(n, e)
                          },
                          json: function(e) {
                              return window.JSON.stringify(t.prepData(n), null, e && "  ")
                          }
                      };
                  return r.formData = o[m.a.opts.dataType](e), document.dispatchEvent(c.a.formSaved), r.formData
              }, r.incrementId = function(e) {
                  var t = e.lastIndexOf("-"),
                      r = parseInt(e.substring(t + 1)) + 1;
                  return e.substring(0, t) + "-" + r
              }, r.getAttrVals = function(t) {
                  var r = Object.create(null),
                      n = t.querySelectorAll('[class*="fld-"]');
                  return Object(p.i)(n, function(t) {
                      var o = n[t],
                          i = Object(p.c)(o.getAttribute("name")),
                          a = [
                              [o.attributes.contenteditable, function() {
                                  return "xml" === m.a.opts.dataType ? Object(p.g)(o.innerHTML) : o.innerHTML
                              }],
                              ["checkbox" === o.type, function() {
                                  return o.checked
                              }],
                              ["number" === o.type && "" !== o.value, function() {
                                  return Number(o.value)
                              }],
                              [o.attributes.multiple, function() {
                                  return e(o).val()
                              }],
                              [!0, function() {
                                  return o.value
                              }]
                          ].find(function(e) {
                              return !!e[0]
                          })[1]();
                      r[i] = a
                  }), r
              }, r.updatePreview = function(t) {
                  var r = this.d,
                      n = t.attr("class"),
                      o = t[0];
                  if (!n.includes("input-control")) {
                      var i = t.attr("type"),
                          l = e(".prev-holder", o),
                          s = Object.assign({}, this.getAttrVals(o, s), {
                              type: i
                          });
                      i.match(r.optionFieldsRegEx) && (s.values = [], s.multiple = e('[name="multiple"]', o).is(":checked"), e(".sortable-options li", o).each(function(t, r) {
                          var n = {
                              selected: e(".option-selected", r).is(":checked"),
                              value: e(".option-value", r).val(),
                              label: e(".option-label", r).val()
                          };
                          s.values.push(n)
                      })), (s = Object(p.y)(s)).className = this.classNames(o, s), t.data("fieldData", s);
                      var u = h.a.lookup(s.type),
                          f = u ? u.class : b.a.getClass(s.type, s.subtype),
                          d = this.layout.build(f, s);
                      Object(a.b)(l[0]), l[0].appendChild(d), d.dispatchEvent(c.a.fieldRendered)
                  }
              }, r.disabledTT = function(e) {
                  var t = e.querySelectorAll(".disabled-field");
                  Object(p.i)(t, function(e) {
                      var r = t[e],
                          n = f.a.get("fieldNonEditable");
                      if (n) {
                          var o = Object(p.p)("p", n, {
                              className: "frmb-tt"
                          });
                          r.appendChild(o), r.addEventListener("mousemove", function(e) {
                              return function(e, t) {
                                  var r = t.field.getBoundingClientRect(),
                                      n = e.clientX - r.left - 21,
                                      o = e.clientY - r.top - t.tt.offsetHeight - 12;
                                  t.tt.style.transform = "translate(" + n + "px, " + o + "px)"
                              }(e, {
                                  tt: o,
                                  field: r
                              })
                          })
                      }
                  })
              }, r.classNames = function(t, r) {
                  var n = t.querySelector(".fld-className"),
                      o = t.querySelector(".btn-style"),
                      i = o && o.value;
                  if (n) {
                      var a = r.type,
                          l = n.multiple ? e(n).val() : n.value.trim().split(" "),
                          s = {
                              button: "btn",
                              submit: "btn"
                          }[a];
                      if (s && i) {
                          for (var u = 0; u < l.length; u++) {
                              var f = new RegExp("^" + s + "-.*", "g");
                              l[u].match(f) ? l.splice(u, 1, s + "-" + i) : l.push(s + "-" + i)
                          }
                          l.push(s)
                      }
                      var c = Object(p.z)(l).join(" ").trim();
                      return n.value = c, c
                  }
              }, r.closeConfirm = function(e, t) {
                  e || (e = document.getElementsByClassName("form-builder-overlay")[0]), e && Object(a.f)(e), t || (t = document.getElementsByClassName("form-builder-dialog")[0]), t && Object(a.f)(t), document.removeEventListener("keydown", this.handleKeyDown, !1), document.dispatchEvent(c.a.modalClosed)
              }, r.handleKeyDown = function(e) {
                  27 === (e.keyCode || e.which) && (e.preventDefault(), this.closeConfirm.call(this))
              }, r.editorLayout = function(e) {
                  return {
                      left: {
                          stage: "pull-right",
                          controls: "pull-left"
                      },
                      right: {
                          stage: "pull-left",
                          controls: "pull-right"
                      }
                  }[e] || ""
              }, r.showOverlay = function() {
                  var e = this,
                      t = Object(p.p)("div", null, {
                          className: "form-builder-overlay"
                      });
                  return document.body.appendChild(t), t.classList.add("visible"), t.addEventListener("click", function(t) {
                      var r = t.target;
                      return e.closeConfirm(r)
                  }, !1), document.addEventListener("keydown", this.handleKeyDown, !1), t
              }, r.confirm = function(e, t, r, n) {
                  void 0 === r && (r = !1), void 0 === n && (n = "");
                  var o = this,
                      i = f.a.current,
                      a = o.showOverlay(),
                      l = Object(p.p)("button", i.yes, {
                          className: "yes btn btn-success btn-sm"
                      }),
                      s = Object(p.p)("button", i.no, {
                          className: "no btn btn-danger btn-sm"
                      });
                  s.onclick = function() {
                      o.closeConfirm(a)
                  }, l.onclick = function() {
                      t(), o.closeConfirm(a)
                  };
                  var u = Object(p.p)("div", [s, l], {
                      className: "button-wrap"
                  });
                  n = "form-builder-dialog " + n;
                  var c = Object(p.p)("div", [e, u], {
                      className: n
                  });
                  if (r) c.classList.add("positioned");
                  else {
                      var d = document.documentElement;
                      r = {
                          pageX: Math.max(d.clientWidth, window.innerWidth || 0) / 2,
                          pageY: Math.max(d.clientHeight, window.innerHeight || 0) / 2
                      }, c.style.position = "fixed"
                  }
                  return c.style.left = r.pageX + "px", c.style.top = r.pageY + "px", document.body.appendChild(c), l.focus(), c
              }, r.dialog = function(e, t, r) {
                  void 0 === t && (t = !1), void 0 === r && (r = "");
                  var n = document.documentElement.clientWidth,
                      o = document.documentElement.clientHeight;
                  this.showOverlay(), r = "form-builder-dialog " + r;
                  var i = Object(p.p)("div", e, {
                      className: r
                  });
                  return t ? i.classList.add("positioned") : (t = {
                      pageX: Math.max(n, window.innerWidth || 0) / 2,
                      pageY: Math.max(o, window.innerHeight || 0) / 2
                  }, i.style.position = "fixed"), i.style.left = t.pageX + "px", i.style.top = t.pageY + "px", document.body.appendChild(i), document.dispatchEvent(c.a.modalOpened), -1 !== r.indexOf("data-dialog") && document.dispatchEvent(c.a.viewData), i
              }, r.confirmRemoveAll = function(t) {
                  var r = this,
                      n = t.target.id.match(/frmb-\d{13}/)[0],
                      o = document.getElementById(n),
                      i = f.a.current,
                      a = e("li.form-field", o),
                      l = t.target.getBoundingClientRect(),
                      s = document.body.getBoundingClientRect(),
                      u = {
                          pageX: l.left + l.width / 2,
                          pageY: l.top - s.top - 12
                      };
                  a.length ? r.confirm(i.clearAllMessage, function() {
                      r.removeAllFields.call(r, o), m.a.opts.notify.success(i.allFieldsRemoved), m.a.opts.onClearAll()
                  }, u) : r.dialog(i.noFieldsToClear, u)
              }, r.removeAllFields = function(e, t) {
                  var r = this;
                  void 0 === t && (t = !0);
                  var n = f.a.current,
                      o = m.a.opts,
                      i = e.querySelectorAll("li.form-field"),
                      l = [];
                  if (!i.length) return !1;
                  if (o.prepend && l.push(!0), o.append && l.push(!0), l.some(function(e) {
                          return !0 === e
                      }) || (e.classList.add("empty"), e.dataset.content = n.getStarted), t) {
                      e.classList.add("removing");
                      var s = 0;
                      Object(p.i)(i, function(e) {
                          return s += i[e].offsetHeight + 3
                      }), i[0].style.marginTop = -s + "px", setTimeout(function() {
                          Object(a.b)(e).classList.remove("removing"), r.save()
                      }, 400)
                  } else Object(a.b)(e), this.save()
              }, r.setFieldOrder = function(t) {
                  if (!m.a.opts.sortableControls) return !1;
                  var r = window,
                      n = r.sessionStorage,
                      o = r.JSON,
                      i = [];
                  return t.children().each(function(t, r) {
                      var n = e(r).data("type");
                      n && i.push(n)
                  }), n && n.setItem("fieldOrder", o.stringify(i)), i
              }, r.closeAllEdit = function() {
                  var t = e("> li.editing", this.d.stage),
                      r = e(".toggle-form", this.d.stage),
                      n = e(".frm-holder", t);
                  r.removeClass("open"), t.removeClass("editing"), e(".prev-holder", t).show(), n.hide()
              }, r.toggleEdit = function(t, r) {
                  void 0 === r && (r = !0);
                  var n = document.getElementById(t),
                      o = e(".frm-holder", n),
                      i = e(".prev-holder", n);
                  n.classList.toggle("editing"), e(".toggle-form", n).toggleClass("open"), r ? (i.slideToggle(250), o.slideToggle(250)) : (i.toggle(), o.toggle()), this.updatePreview(e(n)), n.classList.contains("editing") ? (this.formBuilder.currentEditPanel = o[0], m.a.opts.onOpenFieldEdit(o[0]), document.dispatchEvent(c.a.fieldEditOpened)) : (m.a.opts.onCloseFieldEdit(o[0]), document.dispatchEvent(c.a.fieldEditClosed))
              }, r.getStyle = function(e, t) {
                  var r;
                  return void 0 === t && (t = !1), window.getComputedStyle ? r = window.getComputedStyle(e, null) : e.currentStyle && (r = e.currentStyle), t ? r[t] : r
              }, r.stickyControls = function() {
                  var t = this.d,
                      r = t.controls,
                      n = t.stage,
                      o = e(r).parent(),
                      i = r.getBoundingClientRect(),
                      a = n.getBoundingClientRect().top;
                  e(window).scroll(function(t) {
                      var l = e(t.target).scrollTop(),
                          s = {
                              top: 5,
                              bottom: "auto",
                              right: "auto",
                              left: i.left
                          },
                          u = Object.assign({}, s, m.a.opts.stickyControls.offset);
                      if (l > a) {
                          var f = Object.assign({
                                  position: "sticky"
                              }, u),
                              c = r.getBoundingClientRect(),
                              d = n.getBoundingClientRect(),
                              p = c.top + c.height,
                              b = d.top + d.height,
                              h = p === b && c.top > l;
                          p > b && c.top !== d.top && o.css({
                              position: "absolute",
                              top: "auto",
                              bottom: 0,
                              right: 0,
                              left: "auto"
                          }), (p < b || h) && o.css(f)
                      } else r.parentElement.removeAttribute("style")
                  })
              }, r.showData = function() {
                  var e = this.getFormData(m.a.opts.dataType, !0);
                  "xml" === m.a.opts.dataType && (e = Object(p.g)(e));
                  var t = Object(p.p)("code", e, {
                      className: "formData-" + m.a.opts.dataType
                  });
                  this.dialog(Object(p.p)("pre", t), null, "data-dialog")
              }, r.removeField = function(t, r) {
                  void 0 === r && (r = 250);
                  var n = !1,
                      o = this,
                      i = this.d.stage,
                      a = i.getElementsByClassName("form-field");
                  if (!a.length) return m.a.opts.notify.warning("No fields to remove"), !1;
                  if (!t) {
                      var l = [].slice.call(a).map(function(e) {
                          return e.id
                      });
                      m.a.opts.notify.warning("fieldID required to remove specific fields."), m.a.opts.notify.warning("Removing last field since no ID was supplied."), m.a.opts.notify.warning("Available IDs: " + l.join(", ")), t = i.lastChild.id
                  }
                  var s = document.getElementById(t),
                      u = e(s);
                  if (!s) return m.a.opts.notify.warning("Field not found"), !1;
                  u.slideUp(r, function() {
                      u.removeClass("deleting"), u.remove(), n = !0, o.save(), i.childNodes.length || (i.classList.add("empty"), i.dataset.content = f.a.current.getStarted)
                  });
                  var d = m.a.opts.typeUserEvents[s.type];
                  return d && d.onremove && d.onremove(s), document.dispatchEvent(c.a.fieldRemoved), n
              }, r.processActionButtons = function(e) {
                  var t = e.label,
                      r = e.events,
                      n = g(e, ["label", "events"]),
                      o = t,
                      i = this.data;
                  o = o ? f.a.current[o] || o : n.id ? f.a.current[n.id] || Object(p.d)(n.id) : "", n.id ? n.id = i.formID + "-" + n.id + "-action" : n.id = i.formID + "-action-" + Math.round(1e3 * Math.random());
                  var a = Object(p.p)("button", o, n);
                  if (r) {
                      var l = function(e) {
                          r.hasOwnProperty(e) && a.addEventListener(e, function(t) {
                              return r[e](t)
                          })
                      };
                      for (var s in r) l(s)
                  }
                  return a
              }, r.processSubtypes = function(e) {
                  var t = m.a.opts.disabledSubtypes;
                  for (var r in e) e.hasOwnProperty(r) && b.a.register(e[r], b.a.getClass(r), r);
                  var n = b.a.getRegisteredSubtypes(),
                      o = Object.entries(n).reduce(function(e, r) {
                          var n = r[0],
                              o = r[1];
                          return e[n] = t[n] && Object(p.x)(t[n], o) || o, e
                      }, {}),
                      i = {};
                  for (var a in o)
                      if (o.hasOwnProperty(a)) {
                          var l = [],
                              s = o[a],
                              u = Array.isArray(s),
                              f = 0;
                          for (s = u ? s : s[Symbol.iterator]();;) {
                              var c;
                              if (u) {
                                  if (f >= s.length) break;
                                  c = s[f++]
                              } else {
                                  if ((f = s.next()).done) break;
                                  c = f.value
                              }
                              var d = c,
                                  h = b.a.getClass(a, d),
                                  g = h.mi18n("subtype." + d) || h.mi18n(d) || d;
                              l.push({
                                  label: g,
                                  value: d
                              })
                          }
                          i[a] = l
                      }
                  return i
              }, r.editorUI = function(e) {
                  var t = this.d,
                      r = this.data,
                      n = e || r.formID;
                  t.editorWrap = Object(p.p)("div", null, {
                      id: r.formID + "-form-wrap",
                      className: "form-wrap form-builder " + Object(p.q)()
                  }), t.stage = Object(p.p)("ul", null, {
                      id: n,
                      className: "frmb stage-wrap " + r.layout.stage
                  }), t.controls = Object(p.p)("ul", null, {
                      id: n + "-control-box",
                      className: "frmb-control"
                  });
                  var o = this.formActionButtons();
                  t.formActions = Object(p.p)("div", o, {
                      className: "form-actions btn-group"
                  })
              }, r.formActionButtons = function() {
                  var e = this,
                      t = m.a.opts;
                  return t.actionButtons.map(function(r) {
                      if (r.id && -1 === t.disabledActionButtons.indexOf(r.id)) return e.processActionButtons(r)
                  }).filter(Boolean)
              }, r.processOptions = function(e) {
                  var t = this,
                      r = e.actionButtons,
                      n = e.replaceFields,
                      o = g(e, ["actionButtons", "replaceFields"]),
                      i = o.fieldEditContainer;
                  "string" == typeof o.fieldEditContainer && (i = document.querySelector(o.fieldEditContainer));
                  var a = [{
                      type: "button",
                      id: "clear",
                      className: "clear-all btn btn-danger",
                      events: {
                          click: t.confirmRemoveAll.bind(t)
                      }
                  }, {
                      type: "button",
                      label: "viewJSON",
                      id: "data",
                      className: "btn btn-default get-data",
                      events: {
                          click: t.showData.bind(t)
                      }
                  }, {
                      type: "button",
                      id: "save",
                      className: "btn btn-primary save-template",
                      events: {
                          click: function(e) {
                              t.save(), m.a.opts.onSave(e, t.data.formData)
                          }
                      }
                  }].concat(r);
                  return o.fields = o.fields.concat(n), o.disableFields = o.disableFields.concat(n.map(function(e) {
                      var t = e.type;
                      return t && t
                  })), "xml" === o.dataType && (o.disableHTMLLabels = !0), m.a.opts = Object.assign({}, {
                      actionButtons: a
                  }, {
                      fieldEditContainer: i
                  }, o), m.a.opts
              }, r.input = function(e) {
                  return void 0 === e && (e = {}), Object(p.p)("input", null, e)
              }, r.getFormData = function(e, t) {
                  void 0 === e && (e = "js"), void 0 === t && (t = !1);
                  var r = this;
                  return {
                      js: function() {
                          return r.prepData(r.d.stage)
                      },
                      xml: function() {
                          return r.xmlSave(r.d.stage)
                      },
                      json: function(e) {
                          return window.JSON.stringify(r.prepData(r.d.stage), null, e && "  ")
                      }
                  }[e](t)
              }, t
          }(),
          y = (n(12), function() {
              function e(e, t) {
                  this.opts = e, this.dom = t.controls, this.custom = h.a, this.getClass = b.a.getClass, this.getRegistered = b.a.getRegistered, b.a.controlConfig = e.controlConfig || {}, this.init()
              }
              var t = e.prototype;
              return t.init = function() {
                  this.setupControls(), this.appendControls()
              }, t.setupControls = function() {
                  var e = this,
                      t = this.opts;
                  b.a.loadCustom(t.controls), Object.keys(t.fields).length && h.a.register(t.templates, t.fields);
                  var r = b.a.getRegistered();
                  this.registeredControls = r;
                  var n = h.a.getRegistered();
                  n && jQuery.merge(r, n), t.sortableControls && this.dom.classList.add("sort-enabled"), this.controlList = [], this.allControls = {};
                  for (var o = 0; o < r.length; o++) {
                      var i = r[o],
                          a = h.a.lookup(i),
                          l = void 0;
                      if (a) l = a.class;
                      else if (a = {}, !(l = b.a.getClass(i)) || !l.active(i)) continue;
                      var s = a.icon || l.icon(i),
                          u = a.label || l.label(i),
                          f = s ? "" : a.iconClassName || "icon-" + i.replace(/-[\d]{4}$/, "");
                      s && (u = '<span class="control-icon">' + s + "</span>" + u);
                      var c = Object(p.p)("li", Object(p.p)("span", u), {
                          className: f + " input-control input-control-" + o
                      });
                      c.dataset.type = i, this.controlList.push(i), this.allControls[i] = c
                  }
                  t.inputSets.length && t.inputSets.forEach(function(t, r) {
                      var n = t.name,
                          o = t.label;
                      n = n || Object(p.m)(o), t.icon && (o = '<span class="control-icon">' + t.icon + "</span>" + o);
                      var i = Object(p.p)("li", o, {
                          className: "input-set-control input-set-" + r
                      });
                      i.dataset.type = n, e.controlList.push(n), e.allControls[n] = i
                  })
              }, t.orderFields = function(e) {
                  var t, r = this.opts,
                      n = r.controlOrder.concat(e);
                  return window.sessionStorage && (r.sortableControls ? t = window.sessionStorage.getItem("fieldOrder") : window.sessionStorage.removeItem("fieldOrder")), t ? (t = window.JSON.parse(t), t = Object(p.z)(t.concat(e)), t = Object.keys(t).map(function(e) {
                      return t[e]
                  })) : t = Object(p.z)(n), t.forEach(function(e) {
                      var r = new RegExp("-[\\d]{4}$");
                      if (e.match(r)) {
                          var n = t.indexOf(e.replace(r, "")); - 1 !== n && (t.splice(t.indexOf(e), 1), t.splice(n + 1, t.indexOf(e), e))
                      }
                  }), r.disableFields.length && (t = t.filter(function(e) {
                      return -1 == r.disableFields.indexOf(e)
                  })), t.filter(Boolean)
              }, t.appendControls = function() {
                  var e = this;
                  Object(a.b)(this.dom), this.orderFields(this.controlList).forEach(function(t) {
                      var r = e.allControls[t];
                      r && e.dom.appendChild(r)
                  })
              }, e
          }());

      function w(e, t) {
          if (null == e) return {};
          var r, n, o = {},
              i = Object.keys(e);
          for (n = 0; n < i.length; n++) r = i[n], t.indexOf(r) >= 0 || (o[r] = e[r]);
          return o
      }

      function x(e, t, r) {
          return t in e ? Object.defineProperty(e, t, {
              value: r,
              enumerable: !0,
              configurable: !0,
              writable: !0
          }) : e[t] = r, e
      }
      var A = function(e, t, r) {
              var n = this,
                  o = this,
                  l = f.a.current,
                  u = "frmb-" + (new Date).getTime(),
                  b = new s(u),
                  h = new a.a(u);
              e.layout || (e.layout = d.a);
              var g = new e.layout(e.layoutTemplates, !0),
                  A = new v(u, g, o),
                  O = p.p;
              e = A.processOptions(e), b.layout = A.editorLayout(e.controlPosition), A.editorUI(u), b.formID = u, b.lastID = b.formID + "-fld-1";
              var k = new y(e, h),
                  j = m.a.subtypes = A.processSubtypes(e.subtypes),
                  q = r(h.stage),
                  C = r(h.controls);
              q.sortable({
                  cursor: "move",
                  opacity: .9,
                  revert: 150,
                  beforeStop: function(e, t) {
                      return A.beforeStop.call(A, e, t)
                  },
                  start: function(e, t) {
                      return A.startMoving.call(A, e, t)
                  },
                  stop: function(e, t) {
                      return A.stopMoving.call(A, e, t)
                  },
                  cancel: ["input", "select", "textarea", ".disabled-field", ".form-elements", ".btn", "button", ".is-locked"].join(", "),
                  placeholder: "frmb-placeholder"
              }), e.allowStageSort || q.sortable("disable"), C.sortable({
                  helper: "clone",
                  opacity: .9,
                  connectWith: q,
                  cancel: ".fb-separator",
                  cursor: "move",
                  scroll: !1,
                  placeholder: "ui-state-highlight",
                  start: function(e, t) {
                      return A.startMoving.call(A, e, t)
                  },
                  stop: function(e, t) {
                      return A.stopMoving.call(A, e, t)
                  },
                  revert: 150,
                  beforeStop: function(e, t) {
                      return A.beforeStop.call(A, e, t)
                  },
                  distance: 3,
                  update: function(t, r) {
                      if (A.doCancel) return !1;
                      r.item.parent()[0] === h.stage ? (A.doCancel = !0, E(r.item)) : (A.setFieldOrder(C), A.doCancel = !e.sortableControls)
                  }
              });
              var E = function(t) {
                      if (t[0].classList.contains("input-set-control")) {
                          var r = [],
                              n = e.inputSets.find(function(e) {
                                  return Object(p.m)(e.name || e.label) === t[0].dataset.type
                              });
                          if (n && n.showHeader) {
                              var o = {
                                  type: "header",
                                  subtype: "h2",
                                  id: n.name,
                                  label: n.label
                              };
                              r.push(o)
                          }
                          r.push.apply(r, n.fields), r.forEach(function(e) {
                              S(e, !0), (A.stopIndex || 0 === A.stopIndex) && A.stopIndex++
                          })
                      } else S(t, !0)
                  },
                  L = r(h.editorWrap),
                  N = O("div", h.controls, {
                      id: b.formID + "-cb-wrap",
                      className: "cb-wrap " + b.layout.controls
                  });
              e.showActionButtons && N.appendChild(h.formActions), L.append(h.stage, N), "textarea" !== t.type ? r(t).append(L) : r(t).replaceWith(L), r(h.controls).on("click", "li", function(e) {
                  var t = e.target,
                      n = r(t).closest("li");
                  A.stopIndex = void 0, E(n), A.save.call(A)
              });
              var S = function(t, n) {
                      void 0 === n && (n = !1);
                      var o = {};
                      if (t instanceof jQuery)
                          if (o.type = t[0].dataset.type, o.type) {
                              var i = k.custom.lookup(o.type);
                              if (i) o = Object.assign({}, i);
                              else {
                                  var a = k.getClass(o.type);
                                  o.label = a.label(o.type)
                              }
                          } else {
                              var l = t[0].attributes;
                              n || (o.values = t.children().map(function(e, t) {
                                  return {
                                      label: r(t).text(),
                                      value: r(t).attr("value"),
                                      selected: Boolean(r(t).attr("selected"))
                                  }
                              }));
                              for (var s = l.length - 1; s >= 0; s--) o[l[s].name] = l[s].value
                          } else o = Object.assign({}, t);
                      o.name || (o.name = Object(p.r)(o)), n && ["text", "number", "file", "date", "select", "textarea", "autocomplete"].includes(o.type) && (o.className = o.className || "form-control");
                      var u = /(?:^|\s)btn-(.*?)(?:\s|$)/g.exec(o.className);
                      u && (o.style = u[1]), n && (o = Object.assign({}, o, e.onAddField(b.lastID, o)), setTimeout(function() {
                          return document.dispatchEvent(c.a.fieldAdded)
                      }, 10)), V(o, n), h.stage.classList.remove("empty")
                  },
                  T = function(t) {
                      var n, o;
                      (t = A.getData(t)) && t.length ? (t.forEach(function(e) {
                          return S(Object(p.y)(e))
                      }), h.stage.classList.remove("empty")) : e.defaultFields && e.defaultFields.length ? (e.defaultFields.forEach(function(e) {
                          return S(e)
                      }), h.stage.classList.remove("empty")) : e.prepend || e.append || (h.stage.classList.add("empty"), h.stage.dataset.content = f.a.get("getStarted")), n = [], o = function(t) {
                          return O("li", e[t], {
                              className: "disabled-field form-" + t
                          })
                      }, e.prepend && !r(".disabled-field.form-prepend", h.stage).length && (n.push(!0), q.prepend(o("prepend"))), e.append && !r(".disabled-field.form-.append", h.stage).length && (n.push(!0), q.append(o("append"))), A.disabledTT(h.stage), n.some(function(e) {
                          return !0 === e
                      }) && h.stage.classList.remove("empty"), A.save()
                  },
                  D = function(e) {
                      var t, r = e.type,
                          n = e.values,
                          o = e.name,
                          i = [O("a", f.a.get("addOption"), {
                              className: "add add-opt"
                          })],
                          a = [O("label", f.a.get("selectOptions"), {
                              className: "false-label"
                          })],
                          l = e.multiple || "checkbox-group" === r;
                      if (n && n.length) t = n.map(function(e) {
                          return Object.assign({}, {
                              selected: !1
                          }, e)
                      });
                      else {
                          var s = [1, 2, 3];
                          ["checkbox-group", "checkbox"].includes(r) && (s = [1]);
                          var u = (t = s.map(function(e) {
                              return t = "" + f.a.get("optionCount", e), n = {
                                  label: t,
                                  value: Object(p.m)(t)
                              }, "autocomplete" !== r && (n.selected = !1), n;
                              var t, n
                          }))[0];
                          u.hasOwnProperty("selected") && "radio-group" !== r && (u.selected = !0)
                      }
                      var c = O("div", i, {
                              className: "option-actions"
                          }),
                          d = O("ol", t.map(function(e) {
                              return Y(o, e, l)
                          }), {
                              className: "sortable-options"
                          }),
                          m = O("div", [d, c], {
                              className: "sortable-options-wrap"
                          });
                      return a.push(m), O("div", a, {
                          className: "form-group field-options"
                      }).outerHTML
                  },
                  B = function(t) {
                      var r, n = t.type,
                          o = [],
                          i = function(e) {
                              var t = ["required", "label", "description", "placeholder", "className", "name", "access", "value"],
                                  r = !["header", "paragraph", "file", "autocomplete"].concat(h.optionFields).includes(e),
                                  n = {
                                      autocomplete: t.concat(["options", "requireValidOption"]),
                                      button: ["label", "subtype", "style", "className", "name", "value", "access"],
                                      checkbox: ["required", "label", "description", "toggle", "inline", "className", "name", "access", "other", "options"],
                                      text: t.concat(["subtype", "maxlength"]),
                                      date: t,
                                      file: t.concat(["subtype", "multiple"]),
                                      header: ["label", "subtype", "className", "access"],
                                      hidden: ["name", "value", "access"],
                                      paragraph: ["label", "subtype", "className", "access"],
                                      number: t.concat(["min", "max", "step"]),
                                      select: t.concat(["multiple", "options"]),
                                      textarea: t.concat(["subtype", "maxlength", "rows"])
                                  };
                              n["checkbox-group"] = n.checkbox, n["radio-group"] = n.checkbox;
                              var o = n[e];
                              return "radio-group" === e && Object(p.u)("toggle", o), ["header", "paragraph", "button"].includes(e) && Object(p.u)("description", o), r || Object(p.u)("value", o), o || t
                          }(n),
                          a = {
                              required: function() {
                                  return Q(t)
                              },
                              toggle: function() {
                                  return I("toggle", t, {
                                      first: f.a.get("toggle")
                                  })
                              },
                              inline: function() {
                                  var e = {
                                      first: f.a.get("inline"),
                                      second: f.a.get("inlineDesc", n.replace("-group", ""))
                                  };
                                  return I("inline", t, e)
                              },
                              label: function() {
                                  return H("label", t)
                              },
                              description: function() {
                                  return H("description", t)
                              },
                              subtype: function() {
                                  return U("subtype", t, j[n])
                              },
                              style: function() {
                                  return z(t.style)
                              },
                              placeholder: function() {
                                  return H("placeholder", t)
                              },
                              rows: function() {
                                  return P("rows", t)
                              },
                              className: function(e) {
                                  return H("className", t, e)
                              },
                              name: function(e) {
                                  return H("name", t, e)
                              },
                              value: function() {
                                  return H("value", t)
                              },
                              maxlength: function() {
                                  return P("maxlength", t)
                              },
                              access: function() {
                                  var n = ['<div class="available-roles" ' + (t.role ? 'style="display:block"' : "") + ">"];
                                  for (r in e.roles)
                                      if (e.roles.hasOwnProperty(r)) {
                                          var o = "fld-" + b.lastID + "-roles-" + r,
                                              i = {
                                                  type: "checkbox",
                                                  name: "roles[]",
                                                  value: r,
                                                  id: o,
                                                  className: "roles-field"
                                              };
                                          s.includes(r) && (i.checked = "checked"), n.push('<label for="' + o + '">'), n.push(A.input(i).outerHTML), n.push(" " + e.roles[r] + "</label>")
                                      }
                                  n.push("</div>");
                                  var a = {
                                      first: f.a.get("roles"),
                                      second: f.a.get("limitRole"),
                                      content: n.join("")
                                  };
                                  return I("access", t, a)
                              },
                              other: function() {
                                  return I("other", t, {
                                      first: f.a.get("enableOther"),
                                      second: f.a.get("enableOtherMsg")
                                  })
                              },
                              options: function() {
                                  return D(t)
                              },
                              requireValidOption: function() {
                                  return I("requireValidOption", t, {
                                      first: " ",
                                      second: f.a.get("requireValidOption")
                                  })
                              },
                              multiple: function() {
                                  var e = {
                                      default: {
                                          first: "Multiple",
                                          second: "set multiple attribute"
                                      },
                                      file: {
                                          first: f.a.get("multipleFiles"),
                                          second: f.a.get("allowMultipleFiles")
                                      },
                                      select: {
                                          first: " ",
                                          second: f.a.get("selectionsMessage")
                                      }
                                  };
                                  return I("multiple", t, e[n] || e.default)
                              }
                          },
                          s = void 0 !== t.role ? t.role.split(",") : [];
                      ["min", "max", "step"].forEach(function(e) {
                          a[e] = function() {
                              return P(e, t)
                          }
                      });
                      var u = ["name", "className"];
                      if (Object.keys(i).forEach(function(t) {
                              var r = i[t],
                                  l = [!0],
                                  s = e.disabledAttrs.includes(r);
                              if (e.typeUserDisabledAttrs[n]) {
                                  var f = e.typeUserDisabledAttrs[n];
                                  l.push(!f.includes(r))
                              }
                              if (e.typeUserAttrs[n]) {
                                  var c = Object.keys(e.typeUserAttrs[n]);
                                  l.push(!c.includes(r))
                              }
                              s && !u.includes(r) && l.push(!1), l.every(Boolean) && o.push(a[r](s))
                          }), e.typeUserAttrs[n]) {
                          var c = function(e, t) {
                              var r = [],
                                  n = {
                                      array: M,
                                      string: F,
                                      number: P,
                                      boolean: function(e, r) {
                                          var n;
                                          return I(e, function(e) {
                                              for (var t = 1; t < arguments.length; t++) {
                                                  var r = null != arguments[t] ? arguments[t] : {},
                                                      n = Object.keys(r);
                                                  "function" == typeof Object.getOwnPropertySymbols && (n = n.concat(Object.getOwnPropertySymbols(r).filter(function(e) {
                                                      return Object.getOwnPropertyDescriptor(r, e).enumerable
                                                  }))), n.forEach(function(t) {
                                                      x(e, t, r[t])
                                                  })
                                              }
                                              return e
                                          }({}, r, ((n = {})[e] = t[e], n)), {
                                              first: r.label
                                          })
                                      }
                                  };
                              for (var o in e)
                                  if (e.hasOwnProperty(o)) {
                                      var i = R(o, e[o]),
                                          a = f.a.get(o),
                                          s = e[o],
                                          u = s.value || "";
                                      s.value = t[o] || s.value || "", s.label && (l[o] = Array.isArray(s.label) ? f.a.get.apply(f.a, s.label) || s.label[0] : s.label), n[i] && r.push(n[i](o, s)), l[o] = a, s.value = u
                                  }
                              return r.join("")
                          }(e.typeUserAttrs[n], t);
                          o.push(c)
                      }
                      return o.join("")
                  };

              function R(e, t) {
                  return [
                      ["array", function(e) {
                          return !!e.options
                      }],
                      [typeof t.value, function() {
                          return !0
                      }]
                  ].find(function(e) {
                      return e[1](t)
                  })[0] || "string"
              }

              function F(e, t) {
                  var r = t.class,
                      n = t.className,
                      o = w(t, ["class", "className"]),
                      i = {
                          id: e + "-" + b.lastID,
                          title: o.description || o.label || e.toUpperCase(),
                          name: e,
                          type: o.type || "text",
                          className: ["fld-" + e, (r || n || "").trim()]
                      },
                      a = '<label for="' + i.id + '">' + (l[e] || "") + "</label>";
                  return ["checkbox", "checkbox-group", "radio-group"].includes(i.type) || i.className.push("form-control"), i = Object.assign({}, o, i), '<div class="form-group ' + e + '-wrap">' + a + ('<div class="input-wrap">' + ("<input " + Object(p.b)(i) + ">") + "</div>") + "</div>"
              }

              function M(e, t) {
                  var r = t.multiple,
                      n = t.options,
                      o = t.label,
                      i = t.value,
                      a = t.class,
                      s = t.className,
                      u = w(t, ["multiple", "options", "label", "value", "class", "className"]),
                      c = Object.keys(n).map(function(e) {
                          var t = {
                                  value: e
                              },
                              r = n[e],
                              o = Array.isArray(r) ? f.a.get.apply(f.a, r) || r[0] : r;
                          return (Array.isArray(i) ? i.includes(e) : e === i) && (t.selected = null), O("option", o, t)
                      }),
                      d = {
                          id: e + "-" + b.lastID,
                          title: u.description || o || e.toUpperCase(),
                          name: e,
                          className: ("fld-" + e + " form-control " + (a || s || "")).trim()
                      };
                  r && (d.multiple = !0);
                  var p = '<label for="' + d.id + '">' + l[e] + "</label>";
                  return Object.keys(u).forEach(function(e) {
                      d[e] = u[e]
                  }), '<div class="form-group ' + e + '-wrap">' + p + ('<div class="input-wrap">' + O("select", c, d).outerHTML + "</div>") + "</div>"
              }
              var I = function(e, t, r) {
                      void 0 === r && (r = {});
                      var n = function(t) {
                              return O("label", t, {
                                  for: e + "-" + b.lastID
                              }).outerHTML
                          },
                          o = {
                              type: "checkbox",
                              className: "fld-" + e,
                              name: e,
                              id: e + "-" + b.lastID
                          };
                      t[e] && (o.checked = !0);
                      var i = [],
                          a = [O("input", null, o).outerHTML];
                      return r.first && i.push(n(r.first)), r.second && a.push(" ", n(r.second)), r.content && a.push(r.content), a = O("div", a, {
                          className: "input-wrap"
                      }).outerHTML, O("div", i.concat(a), {
                          className: "form-group " + e + "-wrap"
                      }).outerHTML
                  },
                  z = function(e) {
                      var t = "";
                      "undefined" === e && (e = "default");
                      var r = "<label>" + l.style + "</label>";
                      return t += A.input({
                          value: e || "default",
                          type: "hidden",
                          className: "btn-style"
                      }).outerHTML, t += '<div class="btn-group" role="group">', m.d.btn.forEach(function(r) {
                          var n = ["btn-xs", "btn", "btn-" + r];
                          e === r && n.push("selected");
                          var o = O("button", f.a.get("styles.btn." + r), {
                              value: r,
                              type: "button",
                              className: n.join(" ")
                          }).outerHTML;
                          t += o
                      }), (t = O("div", [r, t += "</div>"], {
                          className: "form-group style-wrap"
                      })).outerHTML
                  },
                  P = function(e, t) {
                      var r = t.class,
                          n = t.className,
                          o = t.min,
                          i = void 0 === o ? 0 : o,
                          a = t.max,
                          l = t.step,
                          s = t.value,
                          u = w(t, ["class", "className", "min", "max", "step", "value"])[e] || s,
                          c = f.a.get(e) || e,
                          d = {
                              type: "number",
                              value: u,
                              name: e,
                              min: i,
                              max: a,
                              step: l,
                              placeholder: f.a.get("placeholder." + e),
                              className: ("fld-" + e + " form-control " + (r || n || "")).trim(),
                              id: e + "-" + b.lastID
                          },
                          m = A.input(Object(p.y)(d)).outerHTML;
                      return O("div", ['<label for="' + d.id + '">' + c + "</label>", '<div class="input-wrap">' + m + "</div>"], {
                          className: "form-group " + e + "-wrap"
                      }).outerHTML
                  },
                  U = function(e, t, r) {
                      var n = r.map(function(r, n) {
                              var o = Object.assign({
                                  label: l.option + " " + n,
                                  value: void 0
                              }, r);
                              return r.value === t[e] && (o.selected = !0), o = Object(p.y)(o), O("option", o.label, o)
                          }),
                          o = {
                              id: e + "-" + b.lastID,
                              name: e,
                              className: "fld-" + e + " form-control"
                          },
                          i = f.a.get(e) || Object(p.d)(e) || "",
                          a = O("label", i, {
                              for: o.id
                          }),
                          s = O("select", n, o),
                          u = O("div", s, {
                              className: "input-wrap"
                          });
                      return O("div", [a, u], {
                          className: "form-group " + o.name + "-wrap"
                      }).outerHTML
                  },
                  H = function(t, r, n) {
                      void 0 === n && (n = !1);
                      var o = r[t] || "",
                          i = f.a.get(t);
                      "label" === t && (["paragraph"].includes(r.type) ? i = f.a.get("content") : o = Object(p.t)(o));
                      var a = f.a.get("placeholders." + t) || "",
                          l = "";
                      if (![].some(function(e) {
                              return !0 === e
                          })) {
                          var s = {
                                  name: t,
                                  placeholder: a,
                                  className: "fld-" + t + " form-control",
                                  id: t + "-" + b.lastID
                              },
                              u = O("label", i, {
                                  for: s.id
                              }).outerHTML;
                          "label" !== t || e.disableHTMLLabels ? (s.value = o, s.type = "text", l += "<input " + Object(p.b)(s) + ">") : (s.contenteditable = !0, l += O("div", o, s).outerHTML);
                          var c = '<div class="input-wrap">' + l + "</div>",
                              d = n ? "none" : "block";
                          "value" === t && (d = r.subtype && "quill" === r.subtype && "none"), l = O("div", [u, c], {
                              className: "form-group " + t + "-wrap",
                              style: "display: " + d
                          })
                      }
                      return l.outerHTML
                  },
                  Q = function(e) {
                      var t = e.type,
                          r = [],
                          n = "";
                      return ["header", "paragraph", "button"].includes(t) && r.push(!0), r.some(function(e) {
                          return !0 === e
                      }) || (n = I("required", e, {
                          first: f.a.get("required")
                      })), n
                  },
                  V = function(t, n) {
                      void 0 === n && (n = !0);
                      var i = t.type || "text",
                          a = t.label || (n ? l.get(i) || f.a.get("label") : ""),
                          s = e.disabledFieldButtons[i] || t.disabledFieldButtons,
                          u = [O("a", null, {
                              type: "remove",
                              id: "del_" + b.lastID,
                              className: "del-button btn icon-cancel delete-confirm",
                              title: f.a.get("removeMessage")
                          }), O("a", null, {
                              type: "edit",
                              id: b.lastID + "-edit",
                              className: "toggle-form btn icon-pencil",
                              title: f.a.get("hide")
                          }), O("a", null, {
                              type: "copy",
                              id: b.lastID + "-copy",
                              className: "copy-button btn icon-copy",
                              title: f.a.get("copyButtonTooltip")
                          })];
                      s && Array.isArray(s) && (u = u.filter(function(e) {
                          return !s.includes(e.type)
                      }));
                      var c = [O("div", u, {
                          className: "field-actions"
                      })];
                      c.push(O("label", Object(p.t)(a), {
                          className: "field-label"
                      })), c.push(O("span", " *", {
                          className: "required-asterisk",
                          style: t.required ? "display:inline" : ""
                      }));
                      var d = {
                          className: "tooltip-element",
                          tooltip: t.description,
                          style: t.description ? "display:inline-block" : "display:none"
                      };
                      c.push(O("span", "?", d)), c.push(O("div", "", {
                          className: "prev-holder"
                      }));
                      var m = O("div", [B(t), O("a", f.a.get("close"), {
                              className: "close-field"
                          })], {
                              className: "form-elements"
                          }),
                          g = O("div", m, {
                              id: b.lastID + "-holder",
                              className: "frm-holder",
                              dataFieldId: b.lastID
                          });
                      o.currentEditPanel = g, c.push(g);
                      var v = O("li", c, {
                              class: i + "-field form-field",
                              type: i,
                              id: b.lastID
                          }),
                          y = r(v);
                      y.data("fieldData", {
                          attrs: t
                      }), void 0 !== A.stopIndex ? r("> li", h.stage).eq(A.stopIndex).before(y) : q.append(y), r(".sortable-options", y).sortable({
                          update: function() {
                              return A.updatePreview(y)
                          }
                      }), A.updatePreview(y), e.typeUserEvents[i] && e.typeUserEvents[i].onadd && e.typeUserEvents[i].onadd(v), n && (e.editOnAdd && (A.closeAllEdit(), A.toggleEdit(b.lastID, !1)), v.scrollIntoView && e.scrollToFieldOnAdd && v.scrollIntoView({
                          behavior: "smooth"
                      })), b.lastID = A.incrementId(b.lastID)
                  },
                  Y = function(e, t, r) {
                      var n = {
                              selected: r ? "checkbox" : "radio"
                          },
                          o = ["value", "label", "selected"],
                          i = [];
                      t = Object.assign({
                          selected: !1,
                          label: "",
                          value: ""
                      }, t);
                      for (var a = o.length - 1; a >= 0; a--) {
                          var l = o[a];
                          if (t.hasOwnProperty(l)) {
                              var s = {
                                  type: n[l] || "text",
                                  className: "option-" + l,
                                  value: t[l],
                                  name: e + "-option"
                              };
                              s.placeholder = f.a.get("placeholder." + l) || "", "selected" === l && !0 === t.selected && (s.checked = t.selected), i.push(O("input", null, s))
                          }
                      }
                      var u = {
                          className: "remove btn icon-cancel",
                          title: f.a.get("removeMessage")
                      };
                      return i.push(O("a", null, u)), O("li", i).outerHTML
                  },
                  W = [".form-elements input", ".form-elements select", ".form-elements textarea"].join(", ");
              q.on("change blur keyup click", W, i()(function(e) {
                  if (e) {
                      if ([function(e) {
                              var t = e.type,
                                  r = e.target;
                              return "keyup" === t && "className" === r.name
                          }].some(function(t) {
                              return t(e)
                          })) return !1;
                      A.updatePreview(r(e.target).closest(".form-field")), A.save.call(A)
                  }
              }, 333, {
                  leading: !1
              })), q.on("click touchstart", ".remove", function(t) {
                  var n = r(t.target).parents(".form-field:eq(0)"),
                      o = n[0],
                      i = o.getAttribute("type"),
                      a = r(t.target.parentElement);
                  t.preventDefault(), o.querySelector(".sortable-options").childNodes.length <= 2 && !i.includes("checkbox") ? e.notify.error("Error: " + f.a.get("minOptionMessage")) : a.slideUp("250", function() {
                      a.remove(), A.updatePreview(n), A.save.call(A)
                  })
              }), q.on("touchstart", "input", function(e) {
                  var t = r(n);
                  if (!0 === e.handled) return !1;
                  if ("checkbox" === t.attr("type")) t.trigger("click");
                  else {
                      t.focus();
                      var o = t.val();
                      t.val(o)
                  }
              }), q.on("click touchstart", ".toggle-form, .close-field", function(e) {
                  if (e.stopPropagation(), e.preventDefault(), !0 === e.handled) return !1;
                  var t = r(e.target).parents(".form-field:eq(0)").attr("id");
                  A.toggleEdit(t), e.handled = !0
              }), q.on("dblclick", "li.form-field", function(e) {
                  if (!["select", "input", "label"].includes(e.target.tagName.toLowerCase()) && "true" !== e.target.contentEditable && (e.stopPropagation(), e.preventDefault(), !0 !== e.handled)) {
                      var t = "li" == e.target.tagName ? r(e.target).attr("id") : r(e.target).closest("li.form-field").attr("id");
                      A.toggleEdit(t), e.handled = !0
                  }
              }), q.on("change", '[name="subtype"]', function(e) {
                  var t = r(e.target).closest("li.form-field");
                  r(".value-wrap", t).toggle("quill" !== e.target.value)
              });
              if (q.on("change", [".prev-holder input", ".prev-holder select", ".prev-holder textarea"].join(", "), function(e) {
                      var t;
                      if (!e.target.classList.contains("other-option")) {
                          var r = Object(p.e)(e.target, ".form-field");
                          if (["select", "checkbox-group", "radio-group"].includes(r.type)) {
                              var n = r.getElementsByClassName("option-value");
                              "select" === r.type ? Object(p.i)(n, function(t) {
                                  n[t].parentElement.childNodes[0].checked = e.target.value === n[t].value
                              }) : (t = document.getElementsByName(e.target.name), Object(p.i)(t, function(e) {
                                  n[e].parentElement.childNodes[0].checked = t[e].checked
                              }))
                          } else {
                              var o = document.getElementById("value-" + r.id);
                              o && (o.value = e.target.value)
                          }
                          A.save.call(A)
                      }
                  }), Object(p.a)(h.stage, "keyup change", function(e) {
                      var t = e.target;
                      if (t.classList.contains("fld-label")) {
                          var r = t.value || t.innerHTML;
                          Object(p.e)(t, ".form-field").querySelector(".field-label").innerHTML = Object(p.t)(r)
                      }
                  }), q.on("keyup", "input.error", function(e) {
                      var t = e.target;
                      return r(t).removeClass("error")
                  }), q.on("keyup", 'input[name="description"]', function(e) {
                      var t = r(e.target).parents(".form-field:eq(0)"),
                          n = r(".tooltip-element", t),
                          o = r(e.target).val();
                      if ("" !== o)
                          if (n.length) n.attr("tooltip", o).css("display", "inline-block");
                          else {
                              var i = '<span class="tooltip-element" tooltip="' + o + '">?</span>';
                              r(".field-label", t).after(i)
                          } else n.length && n.css("display", "none")
                  }), q.on("change", ".fld-multiple", function(e) {
                      var t = e.target.checked ? "checkbox" : "radio",
                          n = r(".option-selected", r(e.target).closest(".form-elements"));
                      return n.each(function(e) {
                          return n[e].type = t
                      }), t
                  }), q.on("blur", "input.fld-name", function(e) {
                      e.target.value = Object(p.w)(e.target.value), "" === e.target.value ? r(e.target).addClass("field-error").attr("placeholder", f.a.get("cannotBeEmpty")) : r(e.target).removeClass("field-error")
                  }), q.on("blur", "input.fld-maxlength", function(e) {
                      e.target.value = Object(p.j)(e.target.value)
                  }), q.on("click touchstart", ".icon-copy", function(t) {
                      t.preventDefault();
                      var n = r(t.target).parent().parent("li"),
                          o = function(t) {
                              var n = t.attr("id"),
                                  o = t.attr("type"),
                                  i = o + "-" + (new Date).getTime(),
                                  a = t.clone();
                              return r(".fld-name", a).val(i), a.find("[id]").each(function(e, t) {
                                  t.id = t.id.replace(n, b.lastID)
                              }), a.find("[for]").each(function(e, t) {
                                  var r = t.getAttribute("for").replace(n, b.lastID);
                                  t.setAttribute("for", r)
                              }), a.attr("id", b.lastID), a.attr("name", i), a.addClass("cloned"), r(".sortable-options", a).sortable(), e.typeUserEvents[o] && e.typeUserEvents[o].onclone && e.typeUserEvents[o].onclone(a[0]), b.lastID = A.incrementId(b.lastID), a
                          }(n);
                      o.insertAfter(n), A.updatePreview(o), A.save.call(A)
                  }), q.on("click touchstart", ".delete-confirm", function(t) {
                      t.preventDefault();
                      var n = t.target.getBoundingClientRect(),
                          o = document.body.getBoundingClientRect(),
                          i = {
                              pageX: n.left + n.width / 2,
                              pageY: n.top - o.top - 12
                          },
                          a = r(t.target).parents(".form-field:eq(0)").attr("id"),
                          l = r(document.getElementById(a));
                      if (document.addEventListener("modalClosed", function() {
                              l.removeClass("deleting")
                          }, !1), e.fieldRemoveWarn) {
                          var s = O("h3", f.a.get("warning")),
                              u = O("p", f.a.get("fieldRemoveWarning"));
                          A.confirm([s, u], function() {
                              return A.removeField(a)
                          }, i), l.addClass("deleting")
                      } else A.removeField(a)
                  }), q.on("click", ".style-wrap button", function(e) {
                      var t = r(e.target),
                          n = t.closest(".form-elements"),
                          o = t.val(),
                          i = r(".btn-style", n);
                      i.val(o), t.siblings(".btn").removeClass("selected"), t.addClass("selected"), A.updatePreview(i.closest(".form-field")), A.save()
                  }), q.on("click", ".fld-required", function(e) {
                      r(e.target).closest(".form-field").find(".required-asterisk").toggle()
                  }), q.on("click", "input.fld-access", function(e) {
                      var t = r(e.target).closest(".form-field").find(".available-roles"),
                          n = r(e.target);
                      t.slideToggle(250, function() {
                          n.is(":checked") || r("input[type=checkbox]", t).removeAttr("checked")
                      })
                  }), q.on("click", ".add-opt", function(e) {
                      e.preventDefault();
                      var t = r(e.target).closest(".field-options"),
                          n = r('[name="multiple"]', t),
                          o = r(".option-selected:eq(0)", t),
                          i = !1;
                      i = n.length ? n.prop("checked") : "checkbox" === o.attr("type");
                      var a = o.attr("name").replace(/-option$/, "");
                      r(".sortable-options", t).append(Y(a, !1, i))
                  }), q.on("mouseover mouseout", ".remove, .del-button", function(e) {
                      return r(e.target).closest("li").toggleClass("delete")
                  }), T(), e.disableInjectedStyle) {
                  var J = document.getElementsByClassName("formBuilder-injected-style");
                  Object(p.i)(J, function(e) {
                      return Object(a.f)(J[e])
                  })
              }
              return document.dispatchEvent(c.a.loaded), o.actions = {
                  getFieldTypes: function(t) {
                      return t ? Object(p.x)(k.getRegistered(), e.disableFields) : k.getRegistered()
                  },
                  clearFields: function(e) {
                      return A.removeAllFields(h.stage, e)
                  },
                  showData: A.showData.bind(A),
                  save: A.save.bind(A),
                  addField: function(e, t) {
                      A.stopIndex = b.formData.length ? t : void 0, S(e)
                  },
                  removeField: A.removeField.bind(A),
                  getData: A.getFormData.bind(A),
                  setData: function(e) {
                      A.stopIndex = void 0, A.removeAllFields(h.stage, !1), T(e)
                  },
                  setLang: function(e) {
                      f.a.setCurrent.call(f.a, e).then(function() {
                          h.stage.dataset.content = f.a.get("getStarted"), k.init(), h.empty(h.formActions), A.formActionButtons().forEach(function(e) {
                              return h.formActions.appendChild(e)
                          })
                      })
                  },
                  toggleFieldEdit: function(e) {
                      (Array.isArray(e) ? e : [e]).forEach(function(e) {
                          ["number", "string"].includes(typeof e) && ("number" == typeof e ? e = h.stage.children[e].id : /^frmb-/.test(e) || (e = h.stage.querySelector(e).id), A.toggleEdit(e))
                      })
                  },
                  toggleAllFieldEdit: function() {
                      Object(p.i)(h.stage.children, function(e) {
                          A.toggleEdit(h.stage.children[e].id)
                      })
                  },
                  closeAllFieldEdit: A.closeAllEdit.bind(A)
              }, h.onRender(h.controls, function() {
                  setTimeout(function() {
                      h.stage.style.minHeight = h.controls.clientHeight + "px", e.stickyControls.enable && A.stickyControls(q)
                  }, 0)
              }), o
          },
          O = {
              init: function(e, t) {
                  var r = jQuery.extend({}, m.c, e, !0),
                      n = r.i18n,
                      o = w(r, ["i18n"]);
                  m.a.opts = o;
                  var i = jQuery.extend({}, m.b, n, !0);
                  return O.instance = {
                      actions: {
                          getFieldTypes: null,
                          addField: null,
                          clearFields: null,
                          closeAllFieldEdit: null,
                          getData: null,
                          removeField: null,
                          save: null,
                          setData: null,
                          setLang: null,
                          showData: null,
                          toggleAllFieldEdit: null,
                          toggleFieldEdit: null
                      },
                      get formData() {
                          return O.instance.actions.getData && O.instance.actions.getData("json")
                      },
                      promise: new Promise(function(e, r) {
                          f.a.init(i).then(function() {
                              t.each(function(e) {
                                  var r = new A(o, t[e], jQuery);
                                  jQuery(t[e]).data("formBuilder", r), Object.assign(O, r.actions), O.instance.actions = r.actions
                              }), delete O.instance.promise, e(O.instance)
                          }).catch(function(e) {
                              r(e), o.notify.error(e)
                          })
                      })
                  }, O.instance
              }
          };
      jQuery.fn.formBuilder = function(e) {
          if (void 0 === e && (e = {}), O[e]) {
              for (var t = arguments.length, r = new Array(t > 1 ? t - 1 : 0), n = 1; n < t; n++) r[n - 1] = arguments[n];
              return O[e].apply(this, r)
          }
          var o = O.init(e, this);
          return Object.assign(O, o), o
      }
  }])
}(jQuery);