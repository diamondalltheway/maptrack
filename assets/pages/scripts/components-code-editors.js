var ComponentsCodeEditors = function () {
    
	var mkCode1 = function () {
        var myTextArea = document.getElementById('mkcode1');
        var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
            lineNumbers: true,
            matchBrackets: true,
            styleActiveLine: true,
            theme:"ambiance",
            mode: 'javascript'
        });
    }
    return {
        //main function to initiate the module
        init: function () {
			mkCode1();
        }
    };

}();

jQuery(document).ready(function() {    
   ComponentsCodeEditors.init(); 
});