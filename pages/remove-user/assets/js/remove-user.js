
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.remove form');

    form.addEventListener('submit', function (e) {
      const confirmed = confirm('Are you sure you want to remove this item?');

      if (!confirmed) {
        e.preventDefault(); 
      }
    });
  });

