$(document).ready(function() {
    if($("#target").length){
        if ($("#build").children().children().children().length <= 1) $("#build").children().children().append("<div id='emptydiv'><div class='empty-field'><i class='fa fa-plus'></i></div></div>")
        if($("div").find('#legend').length){
            $("div").find('#legend').attr({"class":"component", "data-toggle":"popover", "title":"", "trigger":"manual", "data-content":"\
                <form class='form'>\
                <div class='form-group col-md-12'>\
                    <label class='control-label'>Title</label> <input class='form-control' type='text' name='form-title' id='form-title'>\
                    <label class='control-label'>Form Name</label> <input class='form-control' type='text' name='form-name' id='form-name'>\
                    <hr/>\
                    <button class='btn btn-info'>Save</button><button class='btn btn-default'>Cancel</button>\
                </div>\
                </form>", "data-html":"true", "data-original-title":"Form Settings"
            });
            if(typeof form_name !== 'undefined') $("legend").attr({"class":"valtype legend-border-title", "data-valtype":"form-title", "data-form-name":"form-name",  "form-name":form_name});
            else $("legend").attr({"class":"valtype legend-border-title", "data-valtype":"form-title", "data-form-name":"form-name", "form-name":'form_name'});
        }
        if($("input[type=text]").length){
            $("#target .form-group").children().children("input[type=text]").parent().parent().attr({"class":"form-group component", "data-type":"text", "data-toggle":"popover", "title":"Field Settings - Text Input", "trigger":"manual", "data-content":"\
                <form class=\'form\'>\
                <div class=\'form-group col-md-12\'>\
                <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                <label class=\'control-label\'>Placeholder</label> <input type=\'text\' name=\'placeholder\' id=\'placeholder\' class=\'form-control\'>\
                <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                <label class=\'control-label\'>Required</label><br>\
                <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required No' name='required' id='required' checked=''><label class='form-check-label' for='required'>Required No</label></div>\
                <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required Yes' name='required' id='requiredyes'><label class='form-check-label'  for='requiredyes'>Required Yes</label></div>\
                <hr/>\
                <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                </div>\
                </form>", "data-html":"true"});
                $("#target .form-group").children().children("input[type=text]").attr({"id":"attr", "class":"form-control input-md valtype", "data-valtype":"placeholder"});
        }
        if($("input[type=number]").length){
            $("#target .form-group").children().children("input[type=number]").parent().parent().attr({"class":"form-group component", "data-type":"text", "data-toggle":"popover", "title":"Field Settings - Number", "trigger":"manual", "data-content":"\
                <form class=\'form\'>\
                <div class=\'form-group col-md-12\'>\
                <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                <label class=\'control-label\'>Placeholder</label> <input type=\'text\' name=\'placeholder\' id=\'placeholder\' class=\'form-control\'>\
                <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                <label class=\'control-label\'>Required</label><br>\
                <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required No' name='required' id='required' checked=''><label class='form-check-label' for='required'>Required No</label></div>\
                <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required Yes' name='required' id='requiredyes'><label class='form-check-label'  for='requiredyes'>Required Yes</label></div>\
                <hr/>\
                <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                </div>\
                </form>", "data-html":"true"});
                $("#target .form-group").children().children("input[type=number]").attr({"id":"attr", "class":"form-control input-md valtype", "data-valtype":"placeholder"});
        }
        if($("input[type=checkbox]").length){
            $("#target .form-group").children().children().children().children("input[type=checkbox]").parent().parent().parent().parent().attr({"class":"form-group component", "data-type":"text", "data-toggle":"popover", "title":"Field Settings - Checkboxes", "trigger":"manual", "data-content":"\
                <form class=\'form\'>\
                <div class=\'form-group col-md-12\'>\
                <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                <label class=\'control-label\'>Group Name Attribute</label> <input class=\'form-control\' type=\'text\' name=\'name\' id=\'name\'>\
                <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                <label class=\'control-label\'>Required</label><br>\
                <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required No' name='required' id='required' checked=''><label class='form-check-label' for='required'>Required No</label></div>\
                <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required Yes' name='required' id='requiredyes'><label class='form-check-label'  for='requiredyes'>Required Yes</label></div>\
                <label class=\'control-label\'>Layout</label><br>\
                <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Inline No\' name=\'inline\' id=\'form-check\' checked=\'\'><label class=\'form-check-label\' for=\'form-check\'>Inline No</label></div>\
                <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Inline Yes\' name=\'inline\' id=\'form-check-inlineyes\'><label class=\'form-check-label\'  for=\'form-check-inlineyes\'>Inline Yes</label></div>\
                <label class=\'control-label\'>Options:</label><div><button id=\'add-option\' class=\'btn btn-success\'>add</button></div>\
                <hr/>\
                <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                </div>\
                </form>", "data-html":"true"
            });
            $("#target .form-group").children().children().children().children("input[type=checkbox]").parent().parent().parent().attr({"class":"col-md-6 valtype", "data-valtype":"checkboxes"});
            $("#target .form-group").children().children().children().children("input[type=checkbox]").attr({"class":"valtype form-check-input", "type":"checkbox"});
        }
        if($("input[type=radio]").length){
            $("#target .form-group").children().children().children().children("input[type=radio]").parent().parent().parent().parent().attr({"class":"form-group component", "data-toggle":"popover", "title":"Multiple Radios", "trigger":"manual",
                "data-content":"\
                <form class=\'form\'>\
                    <div class=\'form-group col-md-12\'>\
                    <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                    <label class=\'control-label\'>Group Name Attribute</label> <input class=\'form-control\' type=\'text\' name=\'name\' id=\'name\'>\
                    <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                    <label class=\'control-label\'>Required</label><br>\
                    <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required No' name='required' id='required' checked=''><label class='form-check-label' for='required'>Required No</label></div>\
                    <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required Yes' name='required' id='requiredyes'><label class='form-check-label'  for='requiredyes'>Required Yes</label></div>\
                    <label class=\'control-label\'>Layout</label><br>\
                    <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Inline No\' name=\'inline\' id=\'form-check\' checked=\'\'><label class=\'form-check-label\' for=\'form-check\'>Inline No</label></div>\
                    <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Inline Yes\' name=\'inline\' id=\'form-check-inlineyes\'><label class=\'form-check-label\'  for=\'form-check-inlineyes\'>Inline Yes</label></div>\
                    <label class=\'control-label\'>Options:</label><div><button id=\'add-option\' class=\'btn btn-success\'>add</button></div>\
                    <hr/>\
                    <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                    </div>\
                </form>", "data-html":"true"
            });
            $("#target .form-group").children().children().children().children("input[type=radio]").parent().parent().parent().attr({"class":"col-md-6 valtype", "data-valtype":"radios"});
            $("#target .form-group").children().children().children().children("input[type=radio]").attr({"class":"valtype form-check-input", "type":"radio"});
        }
        if($("input[type=file]").length){
            $("#target .form-group").children().children("input[type=file]").parent().parent().attr({"class":"form-group component", "data-type":"text", "data-toggle":"popover", "title":"Field Settings - Text Input", "trigger":"manual", "data-content":"\
                <form class=\'form\'>\
                <div class=\'form-group col-md-12\'>\
                <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                <label class=\'control-label\'>Required</label><br>\
                <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required No' name='required' id='required' checked=''><label class='form-check-label' for='required'>Required No</label></div>\
                <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required Yes' name='required' id='requiredyes'><label class='form-check-label'  for='requiredyes'>Required Yes</label></div>\
                <hr/>\
                <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                </div>\
                </form>", "data-html":"true"
            });
            $("#target .form-group").children().children("input[type=file]").attr({"id":"attr", "value":"file_1", "class":"form-control input-md valtype", "type":"file", "data-valtype":"value"});
        }
        if($("input[type=tablemodal]").length){
            $("#target .form-group").children().children("input[type=tablemodal]").parent().parent().attr({"class":"form-group component", "data-type":"text", "data-toggle":"popover", "title":"Field Settings - Table Modal", "trigger":"manual", "data-content":"\
                <form class=\'form\'>\
                <div class=\'form-group col-md-12\'>\
                <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                <label class=\'control-label\'>Placeholder</label> <input type=\'text\' name=\'placeholder\' id=\'placeholder\' class=\'form-control\'>\
                <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                <label class=\'control-label\'>Required</label><br>\
                <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required No' name='required' id='required' checked=''><label class='form-check-label' for='required'>Required No</label></div>\
                <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required Yes' name='required' id='requiredyes'><label class='form-check-label'  for='requiredyes'>Required Yes</label></div>\
                <label class=\'control-label\'>Upload Json Data</label> <input class=\'form-control\' type=\'file\' name=\'json_upload\' id=\'json_upload\'>\
                <hr/>\
                <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                </div>\
                </form>", "data-html":"true"
            });
            $("#target .form-group").children().children("input[type=tablemodal]").attr({"data-toggle":"modal", "type":"tablemodal", "class":"form-control input-md valtype", "data-valtype":"placeholder" });
            $("#target #table-modal").attr({"class":"col-md-6 valtype", "data-valtype":"table-modal"});
        }
        if($("#target .form-group").children().children("button").parent().parent().length){
            $("#target .form-group").children().children("button").parent().parent().attr({"class":"form-group component", "rel":"popover", "title":"Search Input", "trigger":"manual",
                "data-content":"\
                <form class='form'>\
                    <div class=\'form-group col-md-12\'>\
                    <label class=\'control-label\'>Button Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'button\'>\
                    <label class=\'control-label\' id=\'\'>Type: </label>\
                    <select class=\'form-control input-md\' id=\'color\'>\
                        <option id=\'btn-default\'>Default</option>\
                        <option id=\'btn-primary\'>Primary</option>\
                        <option id=\'btn-info\'>Info</option>\
                        <option id=\'btn-success\'>Success</option>\
                        <option id=\'btn-warning\'>Warning</option>\
                        <option id=\'btn-danger\'>Danger</option>\
                        <option id=\'btn-inverse\'>Inverse</option>\
                    </select>\
                    <hr/>\
                    <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                    </div>\
                </form>", "data-html":"true"
            });
            $("#target .form-group").children().children("button").parent().attr({"class":"col-md-6 valtype", "data-valtype":"button"});
        }
        if($("select").length){
            $("#target .form-group").children().children("select").parent().parent().attr({
                "class":"form-group component", "rel":"popover", "title":"Field Settings - Select", "trigger":"manual",
                "data-content":"\
                <form class=\'form\'>\
                <div class=\'form-group col-md-12\'>\
                    <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                    <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                    <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                    <label class=\'control-label\'>Required</label><br>\
                    <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required No' name='required' id='required' checked=''><label class='form-check-label' for='required'>Required No</label></div>\
                    <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required Yes' name='required' id='requiredyes'><label class='form-check-label'  for='requiredyes'>Required Yes</label></div>\
                    <label class=\'control-label\'>Options:</label><div><button id=\'add-option\' class=\'btn btn-success\'>add</button></div>\
                    <hr/>\
                    <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                </div>\
                </form>", "data-html":"true"
            });
            $("#target .form-group").children().children("select").attr({"class":"form-control valtype", "data-valtype":"option"});
        }
        if($("input[type=date]").length){
            $("#target .form-group").children().children().children("input[type=date]").parent().parent().parent().attr({
                "class":"form-group component", "rel":"popover", "title":"Field Settings - Date", "trigger":"manual",
                    "data-content":"\
                    <form class=\'form\'>\
                        <div class=\'form-group col-md-12\'>\
                            <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                            <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                            <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                            <label class=\'control-label\'>Required</label><br>\
                            <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required No' name='required' id='required' checked=''><label class='form-check-label' for='required'>Required No</label></div>\
                            <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required Yes' name='required' id='requiredyes'><label class='form-check-label'  for='requiredyes'>Required Yes</label></div>\
                            <hr/>\
                            <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                        </div>\
                    </form>", "data-html":"true"
            });
            $("#target .form-group").children().children().children("input[type=date]").attr({"class":"form-control input-md valtype", "data-valtype":"date"});
        }
        if($("input[type=time]").length){
            $("#target .form-group").children().children().children("input[type=time]").parent().parent().parent().attr({
                "class":"form-group component", "rel":"popover", "title":"Field Settings - Time", "trigger":"manual",
                    "data-content":"\
                    <form class=\'form\'>\
                        <div class=\'form-group col-md-12\'>\
                            <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                            <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                            <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                            <label class=\'control-label\'>Required</label><br>\
                            <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required No' name='required' id='required' checked=''><label class='form-check-label' for='required'>Required No</label></div>\
                            <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required Yes' name='required' id='requiredyes'><label class='form-check-label'  for='requiredyes'>Required Yes</label></div>\
                            <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                            <hr/>\
                            <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                        </div>\
                    </form>", "data-html":"true"
            });
            $("#target .form-group").children().children().children("input[type=time]").attr({"class":"form-control valtype"});
        }
        if($("input[type=datetime]").length){
            $("#target .form-group").children().children().children("input[type=datetime]").parent().parent().parent().attr({
                "class":"form-group form-group component", "rel":"popover", "title":"Field Settings - Datetime", "trigger":"manual",
                    "data-content":"\
                    <form class=\'form\'>\
                        <div class=\'form-group col-md-12\'>\
                            <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                            <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                            <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                            <label class=\'control-label\'>Required</label><br>\
                            <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required No' name='required' id='required' checked=''><label class='form-check-label' for='required'>Required No</label></div>\
                            <div class='form-check form-check-inline'><input type='radio' class='form-check-input' value='Required Yes' name='required' id='requiredyes'><label class='form-check-label'  for='requiredyes'>Required Yes</label></div>\
                            <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                            <hr/>\
                            <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                        </div>\
                    </form>", "data-html":"true"
            });
            $("#target .form-group").children().children().children("input[type=datetime]").attr({"class":"form-control datetimepicker-input valtype"});
            $("#target #datetimepicker2").children(".input-group-append").attr({"class":"input-group-append valtype"});
        }
        $('#example_length').parent().parent().remove();
        $('#example_info').parent().parent().remove();
        $(".control-label").attr({"class":"col-md-6 control-label valtype", "data-valtype":'label'});
        $(".help-block").attr({"class":"help-block valtype", "data-valtype":'help'});
    }

    $("form").delegate(".component", "mousedown", function(md) {
        $(".popover").remove();

        md.preventDefault();
        var tops = [];
        var mouseX = md.pageX;
        var mouseY = md.pageY;
        var $temp;
        var timeout;
        var $this = $(this);
        var delays = {
            main: 0,
            form: 220
        }
        var type;

        if ($this.parent().parent().attr("id") === "components") {
            type = "main";
        } else {
            type = "form";
        }

        var delayed = setTimeout(function() {
            if (type === "main") {
                $temp = $("<div id='temp' class='add-field col-sm-1'></div>").append($this.clone());
            } else {
                if ($this.attr("id") !== "legend") {
                    $temp = $("<div id='temp' class='test2 add-field'></div>").append($this);
                }
            }
            $("body").append($temp);
            $temp.css({
                "position": "absolute",
                "top": mouseY - ($temp.height() / 2) + "px",
                "left": mouseX - ($temp.width() / 2) + "px",
                "opacity": "0.9"
            }).show()
            var half_box_height = ($temp.height() / 2);
            var half_box_width = ($temp.width() / 2);
            var $target = $("#target");
            var tar_pos = $target.position();
            var $target_component = $("#target .component");

            $(document).delegate("body", "mousemove", function(mm) {
                var mm_mouseX = mm.pageX;
                var mm_mouseY = mm.pageY;

                $temp.css({
                    "top": mm_mouseY - half_box_height + "px",
                    "left": mm_mouseX - half_box_width + "px"
                });
              
                if (mm_mouseX > tar_pos.left && mm_mouseX < tar_pos.left + $target.width() && mm_mouseY > tar_pos.top && mm_mouseY < tar_pos.top + $target.height() + $temp.height() / 2) {
                    $("#target").css("background-color", "#fafdff");
                    $target_component.css({
                        "border-top": "1px solid white",
                        "border-bottom": "1px solid white"
                    });
                    tops = $.grep($target_component, function(e) {
                        return ($(e).position().top - mm_mouseY + half_box_height > 0 && $(e).attr("id") !== "legend");
                    });
                    if (tops.length > 0) {
                        $(tops[0]).css("border-top", "1px solid #22aaff");
                    } else {
                        if ($target_component.length > 0) {
                            $($target_component[$target_component.length - 1]).css("border-bottom", "1px solid #22aaff");
                            $("#build").children().children().find("#emptydiv").css("background","#F4F9E5")
                        }
                    }
                } else {
                    $("#target").css("background-color", "#fff");
                    $("#build").children().children().find("#emptydiv").css("background","#fff")
                    $target_component.css({
                        "border-top": "1px solid white",
                        "border-bottom": "1px solid white"
                    });
                    $target.css("background-color", "#fff");
                }
            });

            $("body").delegate("#temp", "mouseup", function(mu) {
                mu.preventDefault();
                var mu_mouseX = mu.pageX;
                var mu_mouseY = mu.pageY;
                var tar_pos = $target.position();
                
                $("#target .component").css({
                    "border-top": "1px solid white",
                    "border-bottom": "1px solid white"
                });
                if (mu_mouseX > tar_pos.left && mu_mouseX < tar_pos.left + $target.width() && mu_mouseY > tar_pos.top && mu_mouseY < tar_pos.top + $target.height() + $temp.height() / 2) {
                    if (type === "main") {
                        if($this.attr("id") === "text-input"){                            
                            formInput = '<div class="form-group component" data-type="text" data-toggle="popover" title="Field Settings - Text Input" trigger="manual" data-content="\
                            <form class=\'form\'>\
                            <div class=\'form-group col-md-12\'>\
                            <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                            <label class=\'control-label\'>Placeholder</label> <input type=\'text\' name=\'placeholder\' id=\'placeholder\' class=\'form-control\'>\
                            <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                            <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                            <label class=\'control-label\'>Required</label><br>\
                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required No\' name=\'required\' id=\'required\' checked=\'\'><label class=\'form-check-label\' for=\'required\'>Required No</label></div>\
                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required Yes\' name=\'required\' id=\'requiredyes\'><label class=\'form-check-label\'  for=\'requiredyes\'>Required Yes</label></div>\
                            <hr/>\
                            <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                            </div>\
                            </form>" data-html="true">\
                                <!-- Text input-->\
                                <label class="col-md-6 control-label valtype" for="input01" data-valtype=\'label\'>Text input</label>\
                                <div class="col-md-6">\
                                <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" name="values[attr]" id="attr">\
                                <p class="help-block valtype" data-valtype=\'help\'></p>\
                                </div>\
                            </div>'
                        }else if($this.attr("id") === "number"){
                            formInput = '<div class="form-group component" data-type="text" data-toggle="popover" title="Field Settings - Number" trigger="manual" data-content="\
                            <form class=\'form\'>\
                            <div class=\'form-group col-md-12\'>\
                            <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                            <label class=\'control-label\'>Placeholder</label> <input type=\'text\' name=\'placeholder\' id=\'placeholder\' class=\'form-control\'>\
                            <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                            <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                            <label class=\'control-label\'>Required</label><br>\
                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required No\' name=\'required\' id=\'required\' checked=\'\'><label class=\'form-check-label\' for=\'required\'>Required No</label></div>\
                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required Yes\' name=\'required\' id=\'requiredyes\'><label class=\'form-check-label\'  for=\'requiredyes\'>Required Yes</label></div>\
                            <hr/>\
                            <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                            </div>\
                            </form>" data-html="true">\
                                <label class="col-md-6 control-label valtype" for="input01" data-valtype=\'label\'>Number</label>\
                                <div class="col-md-6">\
                                <input type="number" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" name="values[attr]" id="attr">\
                                <p class="help-block valtype" data-valtype=\'help\'></p>\
                                </div>\
                            </div>'
                        }else if($this.attr("id") === "checkboxes"){
                            formInput = '<div class="form-group component" data-toggle="popover" title="Multiple Checkboxes" trigger="manual"\
                            data-content="\
                            <form class=\'form\'>\
                            <div class=\'form-group col-md-12\'>\
                            <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                            <label class=\'control-label\'>Group Name Attribute</label> <input class=\'form-control\' type=\'text\' name=\'name\' id=\'name\'>\
                            <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                            <label class=\'control-label\'>Required</label><br>\
                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required No\' name=\'required\' id=\'required\' checked=\'\'><label class=\'form-check-label\' for=\'required\'>Required No</label></div>\
                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required Yes\' name=\'required\' id=\'requiredyes\'><label class=\'form-check-label\'  for=\'requiredyes\'>Required Yes</label></div>\
                            <label class=\'control-label\'>Layout</label><br>\
                                <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Inline No\' name=\'inline\' id=\'form-check\' checked=\'\'><label class=\'form-check-label\' for=\'form-check\'>Inline No</label></div>\
                                <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Inline Yes\' name=\'inline\' id=\'form-check-inlineyes\'><label class=\'form-check-label\'  for=\'form-check-inlineyes\'>Inline Yes</label></div>\
                            <label class=\'control-label\'>Options:</label><div><button id=\'add-option\' class=\'btn btn-success\'>add</button></div>\
                            <hr/>\
                            <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                            </div>\
                            </form>" data-html="true">\
                                <label class="col-md-6 control-label valtype" data-valtype="label">Checkboxes</label>\
                                <div class="col-md-6 valtype" data-valtype="checkboxes">\
                                <!-- Multiple Checkboxes -->\
                                <div class="form-check">\
                                <label class="checkbox">\
                                    <input class="form-check-input valtype" type="checkbox" value="Option one" name="values[attr][]">\
                                    Option one\
                                </label>\
                                </div>\
                                </div>\
                            </div>'
                        }else if($this.attr("id") === "radio-buttons"){
                            formInput = '<div class="form-group component" data-toggle="popover" title="Multiple Radios" trigger="manual"\
                            data-content="\
                            <form class=\'form\'>\
                                <div class=\'form-group col-md-12\'>\
                                <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                                <label class=\'control-label\'>Group Name Attribute</label> <input class=\'form-control\' type=\'text\' name=\'name\' id=\'name\'>\
                                <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                                <label class=\'control-label\'>Required</label><br>\
                                <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required No\' name=\'required\' id=\'required\' checked=\'\'><label class=\'form-check-label\' for=\'required\'>Required No</label></div>\
                                <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required Yes\' name=\'required\' id=\'requiredyes\'><label class=\'form-check-label\'  for=\'requiredyes\'>Required Yes</label></div>\
                                <label class=\'control-label\'>Layout</label><br>\
                                <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Inline No\' name=\'inline\' id=\'form-check\' checked=\'\'><label class=\'form-check-label\' for=\'form-check\'>Inline No</label></div>\
                                <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Inline Yes\' name=\'inline\' id=\'form-check-inlineyes\'><label class=\'form-check-label\'  for=\'form-check-inlineyes\'>Inline Yes</label></div>\
                                <label class=\'control-label\'>Options:</label><div><button id=\'add-option\' class=\'btn btn-success\'>add</button></div>\
                                <hr/>\
                                <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                                </div>\
                            </form>" data-html="true">\
                            <label class="col-md-6 control-label valtype" data-valtype="label">Radio buttons</label>\
                            <div class="col-md-6 valtype" data-valtype="radios">\
                                <!-- Multiple Radios -->\
                                <div class="form-check">\
                                <label class="radio">\
                                    <input class="form-check-input valtype" type="radio" value="Option one" name="values[attr][]" checked="checked">\
                                    Option one\
                                </label>\
                                </div>\
                            </div>\
                            </div>'
                        }else if($this.attr("id") === "file-upload"){
                            formInput = '<div class="form-group component" data-type="text" data-toggle="popover" title="Field Settings - File Upload" trigger="manual" data-content="\
                            <form class=\'form\'>\
                            <div class=\'form-group col-md-12\'>\
                            <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                            <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                            <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                            <label class=\'control-label\'>Required</label><br>\
                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required No\' name=\'required\' id=\'required\' checked=\'\'><label class=\'form-check-label\' for=\'required\'>Required No</label></div>\
                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required Yes\' name=\'required\' id=\'requiredyes\'><label class=\'form-check-label\'  for=\'requiredyes\'>Required Yes</label></div>\
                            <hr/>\
                            <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                            </div>\
                            </form>" data-html="true">\
                                <!-- Text input-->\
                                <label class="col-md-6 control-label valtype" for="input01" data-valtype=\'label\'>File Upload</label>\
                                <div class="col-md-6">\
                                <input type="file" value="file_1" class="form-control input-md valtype" data-valtype="value" name="values[attr]" id="attr">\
                                <p class="help-block valtype" data-valtype=\'help\'></p>\
                                </div>\
                            </div>'
                        }else if($this.attr("id") === "table-modal"){
                            formInput = '<div class="form-group component" data-type="text" data-toggle="popover" title="Field Settings - Table Modal" trigger="manual" data-content="\
                            <form class=\'form\'>\
                            <div class=\'form-group col-md-12\'>\
                            <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                            <label class=\'control-label\'>Placeholder</label> <input type=\'text\' name=\'placeholder\' id=\'placeholder\' class=\'form-control\'>\
                            <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                            <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                            <label class=\'control-label\'>Required</label><br>\
                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required No\' name=\'required\' id=\'required\' checked=\'\'><label class=\'form-check-label\' for=\'required\'>Required No</label></div>\
                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required Yes\' name=\'required\' id=\'requiredyes\'><label class=\'form-check-label\'  for=\'requiredyes\'>Required Yes</label></div>\
                            <label class=\'control-label\'>Upload Json Data</label> <input class=\'form-control\' type=\'file\' name=\'json_upload\' id=\'json_upload\'>\
                            <hr/>\
                            <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                            </div>\
                            </form>" data-html="true">\
                                <!-- Table Modal-->\
                                <label class="col-md-6 control-label valtype" for="input01" data-valtype=\'label\'>Table Modal</label>\
                                <div class="col-md-6">\
                                <input data-toggle="modal" data-target="#table-modal-0" type="tablemodal" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" name="values[attr]" id="attr">\
                                <p class="help-block valtype" data-valtype=\'help\'></p>\
                                </div>\
                                <div class="col-md-6 valtype" data-valtype="table-modal" id="table-modal">\
                                </div>\
                            </div>'
                        }else if($this.attr("id") === "button"){
                            formInput = '<div class="form-group component" rel="popover" title="Field Settings - Button" trigger="manual"\
                            data-content="\
                            <form class=\'form\'>\
                                <div class=\'form-group col-md-12\'>\
                                <label class=\'control-label\'>Button Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'button\'>\
                                <label class=\'control-label\' id=\'\'>Type: </label>\
                                <select class=\'form-control input-md\' id=\'color\'>\
                                    <option id=\'btn-default\'>Default</option>\
                                    <option id=\'btn-primary\'>Primary</option>\
                                    <option id=\'btn-info\'>Info</option>\
                                    <option id=\'btn-success\'>Success</option>\
                                    <option id=\'btn-warning\'>Warning</option>\
                                    <option id=\'btn-danger\'>Danger</option>\
                                    <option id=\'btn-inverse\'>Inverse</option>\
                                </select>\
                                <hr/>\
                                <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                                </div>\
                            </form>" data-html="true">\
                            <!-- Button -->\
                            <div class="col-md-6 valtype" data-valtype="button">\
                                <button class=\'btn btn-success\'>Button</button>\
                            </div>\
                            </div>'
                        }else if($this.attr("id") === "select-basic"){
                            formInput = '<div class="form-group component" rel="popover" title="Field Settings - Select" trigger="manual"\
                                        data-content="\
                                        <form class=\'form\'>\
                                        <div class=\'form-group col-md-12\'>\
                                            <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                                            <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                                            <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                                            <label class=\'control-label\'>Required</label><br>\
                                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required No\' name=\'required\' id=\'required\' checked=\'\'><label class=\'form-check-label\' for=\'required\'>Required No</label></div>\
                                            <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required Yes\' name=\'required\' id=\'requiredyes\'><label class=\'form-check-label\'  for=\'requiredyes\'>Required Yes</label></div>\
                                            <label class=\'control-label\'>Options:</label><div><button id=\'add-option\' class=\'btn btn-success\'>add</button></div>\
                                            <hr/>\
                                            <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                                        </div>\
                                        </form>" data-html="true">\
                                        <!-- Select Basic -->\
                                        <label class="col-md-6 control-label valtype" data-valtype="label">Select - Basic</label>\
                                        <div class="col-md-6">\
                                        <select class="form-control valtype" data-valtype="option" name="values[attr]">\
                                            <option value= >-- Select --</option>\
                                            <option>Enter</option>\
                                            <option>Your</option>\
                                            <option>Options</option>\
                                            <option>Here!</option>\
                                        </select>\
                                        <p class="help-block valtype" data-valtype=\'help\'></p>\
                                        </div>\
                                    </div>'
                        }else if($this.attr("id") === "date"){
                            formInput = '<div class="form-group component" rel="popover" title="Field Settings - Date" trigger="manual"\
                            data-content="\
                            <form class=\'form\'>\
                                <div class=\'form-group col-md-12\'>\
                                    <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                                    <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                                    <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                                    <label class=\'control-label\'>Required</label><br>\
                                    <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required No\' name=\'required\' id=\'required\' checked=\'\'><label class=\'form-check-label\' for=\'required\'>Required No</label></div>\
                                    <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required Yes\' name=\'required\' id=\'requiredyes\'><label class=\'form-check-label\'  for=\'requiredyes\'>Required Yes</label></div>\
                                    <hr/>\
                                    <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                                </div>\
                            </form>" data-html="true">\
                                <label class="col-md-6 control-label valtype" data-valtype="label">Date</label>\
                                <div class="col-md-6">\
                                    <div class="input-group">\
                                        <input type="date" class="form-control input-md valtype" data-valtype="date" name="values[attr]">\
                                        <div class="input-group-append">\
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>\
                                        </div>\
                                    </div>\
                                    <p class="help-block valtype" data-valtype=\'help\'></p>\
                                </div>\
                            </div>'
                        }else if($this.attr("id") === "time"){
                            formInput = '<div class="form-group component" rel="popover" title="Field Settings - Time" trigger="manual"\
                            data-content="\
                            <form class=\'form\'>\
                                <div class=\'form-group col-md-12\'>\
                                    <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                                    <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                                    <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                                    <label class=\'control-label\'>Required</label><br>\
                                    <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required No\' name=\'required\' id=\'required\' checked=\'\'><label class=\'form-check-label\' for=\'required\'>Required No</label></div>\
                                    <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required Yes\' name=\'required\' id=\'requiredyes\'><label class=\'form-check-label\'  for=\'requiredyes\'>Required Yes</label></div>\
                                    <hr/>\
                                    <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                                </div>\
                            </form>" data-html="true">\
                                <!-- Select Multiple -->\
                                <label class="col-md-6 control-label valtype" data-valtype="label">Time</label>\
                                <div class="col-md-6">\
                                    <div class="input-group">\
                                        <input class="form-control valtype" type="time" value="13:45:00" name="values[attr]">\
                                        <div class="input-group-append">\
                                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>\
                                        </div>\
                                    </div>\
                                    <p class="help-block valtype" data-valtype=\'help\'></p>\
                                </div>\
                            </div>'
                        }else if($this.attr("id") === "date-time"){
                            formInput = '<div class="form-group form-group component" rel="popover" title="Field Settings - Datetime" trigger="manual"\
                            data-content="\
                            <form class=\'form\'>\
                                <div class=\'form-group col-md-12\'>\
                                    <label class=\'control-label\'>Label Text</label> <input class=\'form-control\' type=\'text\' name=\'label\' id=\'label\'>\
                                    <label class=\'control-label\'>Attribute</label> <input class=\'form-control\' type=\'text\' name=\'attr\' id=\'attr\'>\
                                    <label class=\'control-label\'>Help Text</label> <input type=\'text\' name=\'help\' id=\'help\' class=\'form-control\'>\
                                    <label class=\'control-label\'>Required</label><br>\
                                    <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required No\' name=\'required\' id=\'required\' checked=\'\'><label class=\'form-check-label\' for=\'required\'>Required No</label></div>\
                                    <div class=\'form-check form-check-inline\'><input type=\'radio\' class=\'form-check-input\' value=\'Required Yes\' name=\'required\' id=\'requiredyes\'><label class=\'form-check-label\'  for=\'requiredyes\'>Required Yes</label></div>\
                                    <hr/>\
                                    <button class=\'btn btn-info\'>Save</button><button id=\'delete\' class=\'btn btn-danger\'>Delete</button><button class=\'btn btn-default\'>Cancel</button>\
                                </div>\
                            </form>" data-html="true">\
                                <label class="col-md-6 control-label valtype" data-valtype="label">Datetime</label>\
                                <div class="col-md-6">\
                                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">\
                                        <input type="datetime" class="form-control datetimepicker-input valtype" data-target="#datetimepicker2" data-toggle="datetimepicker" placeholder="DD/MM/YYYY" name="values[attr]"/>\
                                        <div class="input-group-append valtype" data-target="#datetimepicker2" data-toggle="datetimepicker">\
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>\
                                        </div>\
                                    </div>\
                                    <p class="help-block valtype" data-valtype=\'help\'></p>\
                                </div>\
                            </div>'
                        }
                        $temp = $temp.html(formInput);
                        $temp.attr("style", null);
                        // where to add
                        if (tops.length > 0) {
                            $($temp.html()).insertBefore(tops[0]);
                        } else if($target_component.length > 0){
                            $("#target fieldset").append($temp.html());
                        }
                    } else{
                        $temp.attr("style", null);
                        // where to add
                        if (tops.length > 0) {
                            $($temp.html()).insertBefore(tops[0]);
                        } else if($target_component.length > 0){
                            $("#target fieldset").append($temp.html());
                        }
                    } 
                } else {
                    // no add
                    $("#target .component").css({
                        "border-top": "1px solid white",
                        "border-bottom": "1px solid white"
                    });
                    tops = [];
                }
                if ($("#build").children().children().children().length > 2) $("#build").find('#emptydiv').remove()
                else if ($("#build").children().children().children().length <= 1) $("#build").children().children().append("<div id='emptydiv'><div class='empty-field'><i class='fa fa-plus'></i></div></div>")
                //clean up & add popover
                $target.css("background-color", "#fff");
                $(document).undelegate("body", "mousemove");
                $("body").undelegate("#temp", "mouseup");
                $("#target .component").popover({
                    trigger: "manual"
                });
                $temp.remove();
                // get function
            });
        }, delays[type]);

        $(document).mouseup(function() {
            clearInterval(delayed);
            return false;
        });
        $(this).mouseout(function() {
            clearInterval(delayed);
            return false;
        });
    });

    //activate legend popover
    $("#target .component").popover({
        trigger: "manual"
    });
    //popover on click event
    $("#target").delegate(".component", "click", function(e) {
        e.preventDefault();
        $(".popover").hide();
        var $active_component = $(this);
        $active_component.popover("show");
        var valtypes = $active_component.find(".valtype");
        $.each(valtypes, function(i, e) {
            var valIDName  = "#" + $(e).attr("id");
            var valName  = "#" + $(e).attr("name");
            var valIDNameForm  = "#" + $(e).attr("data-form-name");
            var valID = "#" + $(e).attr("data-valtype");
            var valRequired = $(e).attr("required");
            var valLayout = $active_component.find(".form-check, .form-check-inline").attr("class");
            var val;

            if (valID === "#placeholder") {
                console.log(console.log($active_component))
                $active_component.addClass("component-click")
            // #F4F9E5
                val = $(e).attr("placeholder");
                $(".popover " + valID).val(val);
            } else if (valID === "#value") {
                val = $(e).attr("value");
                $(".popover " + valID).val(val);
                valName = $(e).attr("name");
                substrVal = valName.substring(7, valName.length - 1);
                $(".popover " + valIDName).val(substrVal);
            }  else if (valIDName === "#checkbox") {
                val = $(e).attr("checked");
                $(".popover " + valID).attr("checked", val);
            } else if (valID === "#option") {
                val = $.map($(e).find("option"), function(e, i) {
                    return $(e).text();
                });
                $.each(val, function(i, e) {
                    if (i > 0) {
                    if (e.length > 0) {
                        console.log("readois", e)
                        $(".popover #add-option").before('<div class="row"><div class="col-md-10 pr-1"><input id="option" type="text" name="option[]" placeholder="New Option" class="option form-control form-control-sm" value="'+e+'"></div><span id="delete-option" class="trash fa fa-trash"></span></div>')
                        }
                    }
                });
                valName = $(e).attr("name");
                substrVal = valName.substring(7, valName.length - 1);
                $(".popover #attr").val(substrVal);
            } else if (valID === "#checkboxes" ) {
                val = $.map($(e).find("label"), function(e, i) {
                    return $(e).text().trim()
                });
                $.each(val, function(i, e) {
                    if (e.length > 0) {
                        console.log("readois", e)
                        $(".popover #add-option").before('<div class="row"><div class="col-md-10 pr-1"><input id="checkboxes" type="text" name="option[]" placeholder="New Option" class="option form-control form-control-sm" value="'+e+'"></div><span id="delete-option" class="trash fa fa-trash"></span></div>')
                    }
                });
                $(".popover #name").val($(e).find("input").attr("name").substring(7, $(e).find("input").attr("name").length - 3));
            } else if (valID === "#radios") {
                val = $.map($(e).find("label"), function(e, i) {
                    return $(e).text().trim()
                });
                $.each(val, function(i, e) {
                    if (e.length > 0) {
                        console.log("readois", e)
                        $(".popover #add-option").before('<div class="row"><div class="col-md-10 pr-1"><input id="radios" type="text" name="option[]" placeholder="New Option" class="option form-control form-control-sm" value="'+e+'"></div><span id="delete-option" class="trash fa fa-trash"></span></div>')
                    }
                });
                $(".popover #name").val($(e).find("input").attr("name").substring(7, $(e).find("input").attr("name").length - 3));
            } else if (valID === "#table-modal") {
                table_modal_id = $active_component.find('[data-target]');
                $("#json_upload").change(function(event) {
                    console.log("valID ", $(".popover #attr").val());
                    table_modal_id = $active_component.find('[data-valtype="table-modal"]').empty();
                    var reader = new FileReader();
                    reader.onload = onReaderLoad;
                    reader.readAsText(event.target.files[0]);
                });
                function onReaderLoad(event){
                    var obj = JSON.parse(event.target.result);
                    table_modal_json = obj;
                    var id_name;
                    var y =1;
                    var table_html = "";
                    var firstItem = table_modal_json[0];
                    table_html = table_html +
                        '<div class=modal id=table-modal-'+$(".popover #attr").val()+'>';
                    table_html = table_html +  
                            '<div class=\'modal-dialog modal-xl modal-dialog-scrollable\'>\
                                <div class=modal-content>\
                                    <div class=modal-header>\
                                        <h4 class=modal-title>Select Data</h4>\
                                        <button type=button class=close data-dismiss=modal>&times;</button>\
                                    </div>\
                                    <div class=modal-body>\
                                        <div class=table-responsive>\
                                            <table id=example >\
                                                <thead>\
                                                    <th></th>';
                                                    $i = 0;
                                                    for(key in firstItem) {
                                                        if($i>0)table_html = table_html + '<th>'+key+'</th>';
                                                        $i++;
                                                    }
                    table_html = table_html +  '</thead>\
                                                <tbody>\
                                                    <tr>';
                                                        i = 0
                                                        $.each(table_modal_json, function(key1, items) {
                                                            $.each(items, function(key2, item) {
                                                                if(i==0) {
                                                                    id_name = key2;
                                                                    if(id_name == key2) table_html = table_html + '<td><center><input class=tm-radio-'+$(".popover #attr").val()+' type=radio name=values['+$(".popover #attr").val()+'] value='+item+'></center></td>';
                                                                }
                                                                else {
                                                                    if(id_name == key2) table_html = table_html + '</tr><tr><td><center><input class=tm-radio-'+$(".popover #attr").val()+' type=radio name=values['+$(".popover #attr").val()+'] value='+item+'></center></td>';
                                                                    else table_html = table_html + '<td>'+item+'</td>';
                                                                }
                                                                i++;
                                                            });
                                                        });
                    table_html = table_html +       '</tr>\
                                                </tbody>\
                                            </table>\
                                        </div>\
                                    </div>\
                                    <div class=modal-footer>\
                                        <button id=btn-delete-selected-'+$(".popover #attr").val()+' type=button class=\'btn btn-danger\'>Delete Selected</button>\
                                        <button data-dismiss=modal type=button class=\'btn btn-primary\'>Submit Selected</button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>'
                        valueTable = $active_component.find('[data-valtype=table-modal]')
                        $(valueTable).append($(table_html));
                        
                        table_modal_json = 0;
                }
            }else if (valID === "#button") {
                val = $(e).text();
                var type = $(e).find("button").attr("class").split(" ").filter(function(e) {
                    return e.match(/btn-.*/)
                });
                $(".popover #color option").attr("selected", null);
                if (type.length === 0) {
                    $(".popover #color #default").attr("selected", "selected");
                } else {
                    $(".popover #color #" + type[0]).attr("selected", "selected");
                }
                val = $(e).find(".btn").text();
                $(".popover #button").val(val);
            } else if(valID === "#form-title" && valIDNameForm === "#form-name" ){
                valTitle = $(e).text();
                $(".popover " + valID).val(valTitle);
                valName = $(e).attr("form-name");
                $(".popover " + valIDNameForm).val(valName);
            } else {
                val = $(e).text();
                $(".popover " + valID).val(val);
            }
            if(valName.slice(0, 7) === "#values"){
                valName = $(e).attr("name");
                substrVal = valName.substring(7, valName.length - 1);
                $(".popover #attr").val(substrVal);
            }
            if(valRequired === "required"){
                console.log("require")
                $(".popover " + "#"+valRequired+"yes").attr("checked", "checked")
            }
            if(valLayout === "form-check" || valLayout === "form-check-inline"){
                console.log("lay", valLayout)
                $(".popover " + "#"+valLayout+"yes").attr("checked", "checked")
            }
        });

        $(".popover").delegate(".btn-default", "click", function(e) {
            e.preventDefault();
            $active_component.popover("hide");
        });

        $(".popover").delegate(".btn-info", "click", function(e) {
            e.preventDefault();
            var inputs = $(".popover");
            inputs.push($(".popover textarea")[0]);
            inputs.push($(".popover file")[0]);
            inputs.push($(".popover input")[0]);
            inputs.push($(".popover input")[1]);
            inputs.push($(".popover input")[7]);
            inputs.push($(".popover input")[2]);
            inputs.push($(".popover input")[3]);
            inputs.push($(".popover input")[4]);
            inputs.push($(".popover input")[5]);
            inputs.push($(".popover input")[6]);
          
            $.each(inputs, function(i, e) {
                var vartype = $(e).attr("id");
                var value = $active_component.find('[data-valtype="' + vartype + '"]')
                if (vartype === "placeholder") {
                    $(value).attr("placeholder", $(e).val());
                } else if (vartype === "value") {
                    $(value).attr("value", $(e).val());
                } else if (vartype === "checkbox") {
                    if ($(e).is(":checked")) {
                        $(value).attr("checked", true);
                    } else {
                        $(value).attr("checked", false);
                    }
                } else if (vartype === "option") {
                    var label = $(".popover #label").val();
                    var option = $("input[name='option[]']").map(function(){return $(this).val();}).get()
                    $(value).html("")
                    $(value).append("<option value=>-- Select "+label+" --</option>")
                    $.each(option, function(i, e) {
                        if (e.length > 0) $(value).append($("<option>").text(e));
                    });
                } else if (vartype === "checkboxes") {
                    var group_name = $(".popover #name").val();
                    var option = $("input[name='option[]']").map(function(){return $(this).val();}).get()
                    $(value).html("<!-- Multiple checkboxes -->");
                    $.each(option, function(i, e) {
                        if (e.length > 0) $(value).append('<div class="form-check"> <label class="radio"><input type="checkbox" class="form-check-input valtype" value="' + e + '" name="values[' + group_name + '][]">\n        ' + e + '\n      </label></div>');
                    });
                } else if (vartype === "attr") {
                    if($($active_component.find('input[type=tablemodal]').length) !== null){
                        $($active_component.find('input[type=tablemodal]')).attr("id", "tm-radio-"+$(e).val()+"");
                        $($active_component.find('input[type=tablemodal]')).attr("data-target", "#table-modal-"+$(e).val()+"");
                        $($active_component.find('input[type=radio]')).attr("class", "tm-radio-"+$(e).val()+"");
                        $($active_component.find('.btn-danger')).attr("id", "btn-delete-selected-"+$(e).val()+"");
                        $active_component.find('script').remove();
                        $($active_component.find('#table-modal')).append('\
                        <script>\
                            $(\'.table\').DataTable();\
                            $(\'.tm-radio-'+$(".popover #attr").val()+'\').on(\'click\', function(event){\
                                var tds =  new Array();\
                                var class_name = this.className;\
                                var row = $(this).parent().closest(\'tr\');\
                                row.find(\'td\').each (function() {\
                                    var count = $(this).children().length;\
                                    if(count == 0) tds.push($(this).html());\
                                });\
                                var tds_string = tds.join(\', \');\
                                $(\'#\'+class_name).val(tds_string);\
                            });\
                            $(\'.readonly\').on(\'keydown paste\', function(e){e.preventDefault();});\
                            $(\'#btn-delete-selected-'+$(".popover #attr").val()+'\').click(function() {\
                                $(\'.tm-radio-'+$(".popover #attr").val()+'\').prop(\'checked\', false);\
                                $(\'#tm-radio-'+$(".popover #attr").val()+'\').val(\'\');\
                            });\
                        </script>');
                    }
                    if(!!$($active_component.find('.modal')).attr("id")){
                        $($active_component.find('.modal')).attr("id", "table-modal-"+$(e).val()+"");
                    }
                    if($active_component.find('input[type=datetime]').length !== 0){
                        $($active_component.find('input[type=datetime]').parent()).attr("id", "datetimepicker-"+$(e).val()+"");
                        $($active_component.find('input[type=datetime]')).attr("data-target", "#datetimepicker-"+$(e).val()+"");
                        $active_component.find('script').remove();
                        $($active_component.find('input[type=datetime]').parent().parent().parent()).append('\
                        <script>\
                            $(function () {\
                                $(\'#datetimepicker-'+$(e).val()+'\').datetimepicker({\
                                    format: \'DD/MM/YYYY HH:mm\'\
                                });\
                            });\
                        </script>');
                    }
                    $($active_component.find('input')).attr("name", "values["+$(e).val()+"]");
                } else if (vartype === "radios") {
                    var group_name = $(".popover #name").val();
                    var option = $("input[name='option[]']").map(function(){return $(this).val();}).get()
                    $(value).html("\n      <!-- Multiple Radios -->");
                    $.each(option, function(i, e) {
                        if (e.length > 0) {
                            $(value).append('<div class="form-check"> <label class="radio"><input type="radio" class="form-check-input valtype" value="' + e + '" name="values[' + group_name + '][]">\n        ' + e + '\n      </label></div>');
                        }
                    });
                    $(value).append("\n  ")
                    $($(value).find("input")[0]).attr("checked", true)
                } else if (vartype === "button") {
                    var type = $(".popover #color option:selected").attr("id");
                    $(value).find("button").text($(e).val()).attr("class", "btn " + type);
                } else if (vartype === "form-name") {
                    valueFormName = $active_component.find('[data-form-name="' + vartype + '"]');
                    $(valueFormName).attr("form-name", $(e).val());
                } else if (vartype === "required") {
                    if($('input[name=required]:checked').val() === "Required No") $active_component.find("input, select").removeAttr("required");
                    else if($('input[name=required]:checked').val() === "Required Yes") $active_component.find("input, select").attr("required", "required");
                } else if (vartype === "form-check") {
                    if($('input[name=inline]:checked').val() === "Inline Yes") $active_component.find(".form-check").attr("class", "form-check-inline");
                    else if($('input[name=inline]:checked').val() === "Inline No") $active_component.find(".form-check-inline").attr("class", "form-check");
                } else {
                    $(value).text($(e).val());
                }
                $active_component.popover("hide");
                //get function
            });
        });
        $(".popover").delegate("#delete", "click", function(e) {
            e.preventDefault();
            if($active_component.attr("id") != "legend"){
                $active_component.popover("hide");
                setTimeout(function(){
                    $active_component.remove();
                    if ($("#build").children().children().children().length === 1) $("#build").children().children().append("<div id='emptydiv'><div class='empty-field'><i class='fa fa-plus'></i></div></div>")
                }, 150);
            }
        });
        $(".popover").delegate("#delete-option", "click", function(e) {
            e.preventDefault();
            $(this).parent().remove();
        });
        $("#add-option").on("click", function(e) {
            e.preventDefault();
            $(".popover #add-option").before('<div class="row"><div class="col-md-10 pr-1"><input id="inline-radios" type="text" name="option[]" placeholder="New Option" class="option form-control form-control-sm"></div><span id="delete-option" class="trash fa fa-trash"></span></div>');
        });
    });  
});

//   get title form
var getTitle = function() {
    var $title = $("legend").first().text();
    $("#form_title").val($title.replace());
    return $title;
}

//get form name
var getFormName = function() {
    var $formName = $("legend").attr('form-name');
    console.log($formName.replace(/ /g,"_"))
    $("#form_name").val($formName.replace(/ /g,"_"));
    return $formName;
}

  //get attribute form
var getAttr = function() {
    var $value_input  = [];
    i = 0;
    $("#build, .valtype").each(function(index, value){
        nameAttr = $(this).attr('name');
        
        if(!!$(this).attr('name')){
            

            if($(this).attr('name').substring($(this).attr('name').length - 2) === "[]"){
                var duplicate = false;
                var attrs = $(this).attr('name').substring(7, $(this).attr('name').length-3);
                
                $.each($value_input, function (index, value) {
                    if(value === attrs) duplicate= true;
                });
                
                if(!duplicate) $value_input[i++] = attrs;
            }else if($(this).attr('name').substring($(this).attr('name').length - 12) === "[attr_count]"){
                var duplicate = false;
                var attrs = $(this).attr('name').substring(7, $(this).attr('name').length - 13);
                
                $.each($value_input, function (index, value) {
                    if(value === attrs) duplicate= true;
                });
                
                if(!duplicate) $value_input[i++] = attrs;
            }else{
                $value_input[i++] = $(this).attr('name').substring(7, $(this).attr('name').length - 1);
            }
            
        }
    });
    console.log($value_input);
    $("#attr_form").val($value_input);
    return $value_input;
}

//generate php
var genPHP = function() {
    var $temptxt = $("<div>").html($("#build").html());
    
    $($temptxt).find(".component").attr({
        "title": null,
        "data-original-title": null,
        "data-type": null,
        "data-content": null,
        "rel": null,
        "data-toggle": null,
        "trigger": null,
        "data-html": null,
        "style": null
    });
    $($temptxt).find("legend").attr({
        "data-form-name": null,
        "form-name": null
    });
    $($temptxt).find(".valtype").attr("data-valtype", null).removeClass("valtype");
    $($temptxt).find(".component").removeClass("component");
    $($temptxt).find("form").attr({
        "id": null,
        "style": null
    });
    $($temptxt).find("table").attr({
        "class": "table table-striped table-bordered dataTable no-footer"
    });
    $($temptxt).find("#attr").attr({"id": null});
    // console.log("test get html ", $temptxt.html().replace(/\n \ \ \ \ \ | \ |\n/g, ""))
    $("#convert_php").val($temptxt.html().replace(/\n \ \ \ \ \ | \ |\n/g, ""));
}

function addSubForm(mainForm, mainFormAttr){
    var main_form = $.parseHTML(mainForm);
    var table_subform = '';
    table_subform = table_subform +'    <div class=form-group> ';
    table_subform = table_subform +'        <input type=hidden class="valtype" name="values[subform_'+ getFormName().replace(/ /g,"_") +']" value="subform_'+ getFormName().replace(/ /g,"_") +'"> ';
    table_subform = table_subform +'        <input type=hidden name="values[subform_'+ getFormName().replace(/ /g,"_") +'][attr_count]" value="'+ i +'"> ';
    table_subform = table_subform +'        <label class="col-md-6 control-label">'+ getTitle() +'</label> ';
    table_subform = table_subform +'        <div class="col-md-6 table-responsive"> ';
    table_subform = table_subform +"            <table id=example class='table table-bordered'> ";
    table_subform = table_subform +'                <thead class=thead-dark> ';
    $.each(getAttr(), function (index, attr) {
        table_subform = table_subform +'                    <th>'+ attr +'</th> ';
    });
    table_subform = table_subform +'                    <th>action</th> ';
    table_subform = table_subform +'                </thead> ';
    table_subform = table_subform +'                <tbody id=subform-'+ getFormName().replace(/ /g,"_") +'>  ';
    table_subform = table_subform +'                </tbody> ';
    table_subform = table_subform +'            </table> ';
    table_subform = table_subform +'            <button class="btn-xs btn-info" type=button id=tab-subform-'+ getFormName().replace(/ /g,"_") +'><a>Tambah '+ getFormName().replace(/_/g," ") +'</a></button> ';
    table_subform = table_subform +'        </div> ';
    table_subform = table_subform +'    </div> ';
    table_subform = table_subform +'</div>';

    $(main_form).find("input[type!=button]:last").parent().parent().after(table_subform);

    $("#main_form").val(main_form[0].outerHTML.replace(/\n \ \ \ \ \ | \ |\n/g, ""));
    console.log(main_form[0].outerHTML.replace(/\n \ \ \ \ \ | \ |\n/g, ""))
    $("#main_form_attr").val(mainFormAttr + ",subform-"+ getFormName().replace(/ /g,"_"));
}

function updateSubForm(mainForm, subFormName, mainFormAttr){
    var main_form = $.parseHTML(mainForm);
    var table_subform = '';

    table_subform = table_subform +'    <div class=form-group> ';
    table_subform = table_subform +'        <input type=hidden class="valtype" name="values[subform_'+ getFormName().replace(/ /g,"_") +']" value="subform_'+ getFormName().replace(/ /g,"_") +'"> ';
    table_subform = table_subform +'        <input type=hidden name="values[subform_'+ getFormName().replace(/ /g,"_") +'][attr_count]" value="'+ i +'"> ';
    table_subform = table_subform +'        <label class="col-md-6 control-label">'+ getTitle() +'</label> ';
    table_subform = table_subform +'        <div class="col-md-6 table-responsive"> ';
    table_subform = table_subform +"            <table id=example class='table table-bordered'> ";
    table_subform = table_subform +'                <thead class=thead-dark> ';
    $.each(getAttr(), function (index, attr) {
        table_subform = table_subform +'                    <th>'+ attr +'</th> ';
    });
    table_subform = table_subform +'                    <th>action</th> ';
    table_subform = table_subform +'                </thead> ';
    table_subform = table_subform +'                <tbody id=subform-'+ getFormName().replace(/ /g,"_") +'>  ';
    table_subform = table_subform +'                </tbody> ';
    table_subform = table_subform +'            </table> ';
    table_subform = table_subform +'            <button class="btn-xs btn-info" type=button id=tab-subform-'+ getFormName().replace(/ /g,"_") +'><a>Tambah '+ getFormName().replace(/_/g," ") +'</a></button> ';
    table_subform = table_subform +'        </div> ';
    table_subform = table_subform +'    </div> ';
    table_subform = table_subform +'</div>';

    mainFormUpdate = $(main_form).find("#subform-"+ subFormName).parent().parent().parent().replaceWith(table_subform.replace(/\n \ \ \ \ \ \ | \ |\n/g, ""));
    $("#main_form_update").val(main_form[0].outerHTML);
    $("#main_form_attr_update").val(mainFormAttr.replace("subform-"+ subFormName, "subform-"+ getFormName().replace(/ /g,"_")));
}

function deleteSubFormMainForm(mainForm, subFormName, mainFormAttr){
    var main_form = $.parseHTML(mainForm);
    $(main_form).find("#subform-"+ subFormName).parent().parent().parent().remove();

    $("#delete_main_form_sub_form").val(main_form[0].outerHTML);
    $("#delete_main_form_attr_sub_form").val(mainFormAttr.replace(",subform-"+ subFormName, ""));
}