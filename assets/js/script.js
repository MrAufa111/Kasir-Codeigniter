const swall = $(".swall").data("swall");
if (swall) {
	Swal.fire({
		title: "Success",
		text: swall,
		icon: "success",
	});
}

const error = $(".error").data("error");
if (error) {
	Swal.fire({
		title: "error",
		text: error,
		icon: "error",
	});
}

$(document).on("click", ".btn-hapus", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");

	Swal.fire({
		title: "Apakah Kamu Yakin!!!",
		text: "Data Ini akan terhapu secara permanent",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus!",
	}).then((result) => {
		if (result.isConfirmed) {
			document.location.href = href;
		}
	});
});
