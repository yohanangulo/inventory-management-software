
<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script>
    const form = document.querySelector('form')

    form.addEventListener('submit', e => {
      if (!form.checkValidity()) e.preventDefault()
      
      form.classList.add('was-validated')
    })
  </script>
  <script src="./js/main.js"></script>
</body>
</html>