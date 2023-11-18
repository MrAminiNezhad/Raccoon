$(document).ready(function () {
  $(".who-we-are-section .counter").each(function () {
    $(this)
      .prop("Counter", 0)
      .animate(
        {
          Counter: $(this).text(),
        },
        {
          duration: 4000,
          easing: "swing",
          step: function (now) {
            $(this).text(Math.ceil(now));
          },
        }
      );
  });
});

function get_uuid() {
  let config = document.getElementById("search_query").value;

  if (config.indexOf("vless") !== -1) {
    let pattern = /vless:\/\/([\w-]+)@([^:]+):(\d+)/;
    uuid = config.match(pattern)[1];
  } else if (config.indexOf("vmess") !== -1) {
    uuid = JSON.parse(atob(config.replace("vmess://", ""))).id;
  } else {
    window.location.href =
      window.location.href + "search.php?username=" + config;
  }
  window.location.href = window.location.href + "search.php?uuid=" + uuid;
}
