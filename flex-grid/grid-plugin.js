(function() {
    tinymce.create('tinymce.plugins.grid', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {
            ed.addButton('flexrow', {
                title : 'Add a row',
                cmd : 'flexrow',
                image : url + '/flexrow.png'
            });
 
            ed.addButton('flexcol', {
                title : 'Add a column',
                cmd : 'flexcol',
                image : url + '/flexcol.png'
            });
 
            ed.addCommand('flexrow', function() {
                ed.windowManager.open({
                  title: 'Insert Row',
                  body: [
                    {
                      type: 'textbox',
                      name: 'customClass',
                      label: 'Custom Class',
                      value: ''
                    }, 
                    {
                      type: 'listbox',
                      name: 'position',
                      label: 'Position',
                      values: [
                        {
                          text: '--',
                          value: ''
                        },
                        {
                          text: 'Start',
                          value: 'start'
                        }, 
                        {
                          text: 'End',
                          value: 'end'
                        }, 
                        {
                          text: 'Center',
                          value: 'center'
                        }, 
                        {
                          text: 'Space Between',
                          value: 'space-between'
                        }, 
                        {
                          text: 'Space Around',
                          value: 'space-around'
                        }
                      ]
                    }, 
                    {
                      type: 'listbox',
                      name: 'rowAlign',
                      label: 'Column Alignment',
                      values: [
                        {
                          text: '--',
                          value: ''
                        },
                        {
                          text: 'Top',
                          value: 'start'
                        }, 
                        {
                          text: 'Bottom',
                          value: 'end'
                        }, 
                        {
                          text: 'Center',
                          value: 'center'
                        }, 
                        {
                          text: 'Equal Size',
                          value: 'stretch'
                        }
                      ]
                    },
                    {
                      type: 'listbox',
                      name: 'wrap',
                      label: 'Should the columns wrap?',
                      values: [
                        {
                          text: 'Yes',
                          value: 'yes'
                        }, 
                        {
                          text: 'No',
                          value: 'no'
                        }
                      ]
                    },
                  ],
                  onsubmit: function(e) {
                    ed.insertContent(
                      '[flex_row position=&quot;' +
                      e.data.position +
                      '&quot; align=&quot;' +
                      e.data.rowAlign +
                      '&quot; wrap=&quot;' +
                      e.data.wrap +
                      '&quot; class=&quot;' +
                      e.data.customClass +
                      '&quot;]' +
                      ed.selection
                      .getContent() +
                      '[/flex_row]'
                    );
                  }
                });
            });
 
            ed.addCommand('flexcol', function() {
            ed.windowManager.open({
                  title: 'Insert Column',
                  body: [
                    {
                      type: 'textbox',
                      name: 'customClass',
                      label: 'Custom Class',
                      value: ''
                    }, 
                    {
                      type: 'listbox',
                      name: 'colWidth',
                      label: 'Column Width',
                      values: [
                        {
                          text: 'Full Width',
                          value: '12'
                        },
                        {
                          text: '11/12',
                          value: '11'
                        },
                        {
                          text: '10/12 or 5/6',
                          value: '10'
                        },
                        {
                          text: '9/12 or 3/4',
                          value: '9'
                        },
                        {
                          text: '8/12 or 2/3',
                          value: '8'
                        },
                        {
                          text: '7/12',
                          value: '7'
                        },
                        {
                          text: '6/12 or 1/2',
                          value: '6'
                        },
                        {
                          text: '5/12',
                          value: '5'
                        },
                        {
                          text: '4/12 or 1/3',
                          value: '4'
                        },
                        {
                          text: '3/12 or 1/4',
                          value: '3'
                        },
                        {
                          text: '2/12 of 1/6',
                          value: '2'
                        },
                        {
                          text: '1/12',
                          value: '1'
                        }
                      ]
                    },  
                    {
                      type: 'listbox',
                      name: 'colAlign',
                      label: 'Single Column Alignment',
                      values: [ 
                        {
                          text: '--',
                          value: ''
                        },
                        {
                          text: 'Top',
                          value: 'start'
                        }, 
                        {
                          text: 'Bottom',
                          value: 'end'
                        }, 
                        {
                          text: 'Center',
                          value: 'center'
                        }, 
                        {
                          text: 'Equal Size',
                          value: 'stretch'
                        }
                      ]
                    },
                    {
                      type: 'listbox',
                      name: 'contentPosition',
                      label: 'Position of content inside column',
                      values: [
                        {
                          text: '--',
                          value: ''
                        },
                        {
                          text: 'Top',
                          value: 'start'
                        }, 
                        {
                          text: 'Bottom',
                          value: 'end'
                        }, 
                        {
                          text: 'Center',
                          value: 'center'
                        }, 
                        {
                          text: 'Spread out 1',
                          value: 'space-between'
                        }, 
                        {
                          text: 'Spread out 2',
                          value: 'space-around'
                        }
                      ]
                    },
                    {
                      type: 'listbox',
                      name: 'contentAlign',
                      label: 'Distribution of content',
                      values: [ 
                        {
                          text: '--',
                          value: ''
                        },
                        {
                          text: 'Top',
                          value: 'start'
                        }, 
                        {
                          text: 'Bottom',
                          value: 'end'
                        }, 
                        {
                          text: 'Center',
                          value: 'center'
                        }, 
                        {
                          text: 'Equal Size',
                          value: 'stretch'
                        }
                      ]
                    },
                  ],
                  onsubmit: function(e) {
                    ed.insertContent(
                      '[flex_col width=&quot;' +
                      e.data.colWidth +
                      '&quot; align=&quot;' +
                      e.data.colAlign +
                      '&quot; content_position=&quot;' +
                      e.data.contentPosition +
                      '&quot; content_align=&quot;' +
                      e.data.contentAlign +
                      '&quot; class=&quot;' +
                      e.data.customClass +
                      '&quot;]' +
                      ed.selection
                      .getContent() +
                      '[/flex_col]'
                    );
                  }
                });
            });
        },
 
        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },
 
        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'Grid Buttons',
                author : 'Sam',
                authorurl : 'http://wp.tutsplus.com/author/leepham',
                infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                version : "0.1"
            };
        }
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'grid', tinymce.plugins.grid );
})();