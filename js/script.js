$("a.delete_article").on("click", function (e) {
  e.preventDefault();

  if (confirm("Are you sure?")) {
    var frm = $("<form>");
    frm.attr("method", "post");
    frm.attr("action", $(this).attr("href"));
    frm.appendTo("body");
    frm.submit();
  }
});

/*$("#formContact").validate({
  rules: {
    title: {
      required: true,
    },
    content: {
      required: true,
    },
  },
});*/

$("#formContact").validate({
  rules: {
    email: {
      required: true,
      email: true,
    },
    subject: {
      required: true,
    },
    message: {
      required: true,
    },
  },
});
