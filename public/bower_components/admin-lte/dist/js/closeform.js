function openForm() {
	var formContent = document.getElementById("formContent");
	var formAdd = document.getElementById("formAdd");
	formContent.classList.add("hidden");
	formAdd.classList.remove("hidden");
}
function closeForm() {
	var formContent = document.getElementById("formContent");
	var formAdd = document.getElementById("formAdd");
	formContent.classList.remove("hidden");
	formAdd.classList.add("hidden");
}