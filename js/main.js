function previewFile(input) {
  const file = $("[type=file]").get(0).files[0];

  if (file) {
    const reader = new FileReader();

    reader.onload = () => {
      $("#previewImg").attr("src", reader.result);
    };

    reader.readAsDataURL(file);
  }
}

ClassicEditor.create(document.querySelector("#body")).catch((error) => {
  console.error(error);
});

$(function () {
  $(".delete").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete!",
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
        Swal.fire("Deleted!", "Your booking has been Cancel.", "success");
      }
    });
  });
});

$(function () {
  $(".detail").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      title: "Good job!",
      text: "You clicked the button!",
      icon: "success",
      button: "Aww yiss!",

      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, detail!",
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
        Swal.fire("Processing!", "Detail.", "success");
      }
    });
  });
});

$(function () {
  $(".edit").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      title: "Good job!",
      text: "You clicked the button!",
      icon: "success",
      button: "Aww yiss!",

      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, edit!",
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
        Swal.fire("Processing!", "Edit.", "success");
      }
    });
  });
});
