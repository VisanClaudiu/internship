(function ($, Drupal) {
    Drupal.behaviors.hoover = {
      attach: function (context, settings) {
          $('[data-toggle="tooltip"]').tooltip();
      }
    };
  })(jQuery, Drupal);
