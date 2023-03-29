function showHide(self, select) {
  let selector = document.getElementById(select);
  if (self.value == "close") {
    selector.style.display = "none";
    self.value = "open";
  } else {
    selector.style.display = "block";
    self.value = "close";
  }
}
