(function ($, Drupal) {
    Drupal.behaviors.hoover = {
      attach: function (context, settings) {
          $('[data-toggle="tooltip"]', context).tooltip();
      }
    };
  })(jQuery, Drupal);
