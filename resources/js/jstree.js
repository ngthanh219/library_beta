$(document).ready(function() {
    $('#jstree').jstree({
        "core": {
            "check_callback": true
        },
        "plugins": ["wholerow", "sort"],
    });
    $('#jstree').on("changed.jstree", function(e, data) {
        window.open(data.node.a_attr.href);
    }).jstree();
});