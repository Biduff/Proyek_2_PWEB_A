document.addEventListener('DOMContentLoaded', function() {
    const furnitureDropdown = document.getElementById('furniture');
    const customFurnitureContainer = document.getElementById('custom-furniture-container');
    const customFurnitureInput = document.getElementById('custom-furniture');

    furnitureDropdown.addEventListener('change', function() {
        if (furnitureDropdown.value === 'Other') {
            customFurnitureContainer.style.display = 'block';
            customFurnitureInput.setAttribute('required', 'required');
        } else {
            customFurnitureContainer.style.display = 'none';
            customFurnitureInput.removeAttribute('required');
            customFurnitureInput.value = ''; 
        }
    });
});
