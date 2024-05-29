$(document).ready(function () {
  // Function to load a page into the #main-content element
  const loadPage = (page) => {
    $.ajax({
      url: page,
      method: "GET",
      success: (data) => {
        $("#main-content").html(data);
      },
      error: () => {
        $("#main-content").html("<p>Error loading page.</p>");
      },
    });
  };

  // Function to set the active class on the clicked nav link
  const activateNavLink = (link) => {
    $(".nav-link").removeClass("active");
    link.addClass("active");
  };

  // Function to initialize the page and bind event handlers
  const initialize = () => {
    loadPage("Userhomepage.php"); // Load the homepage by default
    activateNavLink($("#home-link")); // Set the home link as active

    // Bind click event to nav links
    $(".nav-link").on("click", function (e) {
      e.preventDefault();
      activateNavLink($(this)); // Set the clicked link as active
      const page = $(this).data("page"); // Get the page to load from data-page attribute
      loadPage(page); // Load the selected page
    });
  };

  initialize(); // Call the initialize function when the document is ready
});
