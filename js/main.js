// toasts messages

const toasts = document.querySelectorAll(".toast");
if (toasts) {
  toasts.forEach((toast) => {
    const bootstrapToast = bootstrap.Toast.getOrCreateInstance(toast);
    bootstrapToast.show();
  });
}
