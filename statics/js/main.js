dojo.provide("ValidationTextarea");
dojo.require("dojox.validate");
dojo.require("dojox.validate.web");
dojo.require("dijit.form.Form");
dojo.require('dijit.form.SimpleTextarea');
dojo.require("dijit.form.ValidationTextBox");
dojo.require('dijit.form.Button');
dojo.require("dijit.form.FilteringSelect");
dojo.require("dijit.form.DateTextBox");
dojo.require("dijit.form.Select");
dojo.require("dojox.form.DropDownSelect");
dojo.require("dijit.form.CheckBox");
dojo.require("parser");

dojo.declare(
    "ValidationTextarea",
    [dijit.form.ValidationTextBox,dijit.form.SimpleTextarea],
    {
        invalidMessage: "Este campo es requerido",

        postCreate: function() {
            this.inherited(arguments);
        },

        validate: function() {
            if(arguments.length==0){
                return this.validate(false);
            }
            return this.inherited(arguments);
        },

        onFocus: function() {
            if (!this.isValid()) {
                this.displayMessage(this.getErrorMessage());
            }
        },

        onBlur: function() {
            this.validate(false);
        }
     }
);
