document.addEventListener('DOMContentLoaded', function() {
    const addProductBtn = document.getElementById("bo_button_addProduct");
    const productForm = document.getElementById("bo_formAddProduct");
    productForm.style.display = "none";

    addProductBtn.addEventListener('click', function() {
        productForm.style.display = "block";
    });

    productForm.addEventListener('submit', function(event) {
        event.preventDefault();
        let name = document.getElementById("name").value;
        let rate = document.getElementById("rate").value;
        let price = document.getElementById("price").value;
        let quantity = document.getElementById("quantity").value;
        let description = document.getElementById("description").value;
        let color = document.getElementById("color").value;
        let material = document.getElementById("material").value;
        let brand = document.getElementById("brand").value;
        let category = document.getElementById("category").value;
        let image = document.getElementById("image").value;

        if(name === "" || rate === "" || price === "" || quantity === "" || description === "" || color === "" || material === "" || brand === "" || category === "" || image === "") {
            alert("Please fill all fields");
            return;
        }

        if(isNaN(rate)){
            alert("Please enter a valid rate");
            return;
        }
        if(isNaN(price)){
            alert("Please enter a valid price");
            return;
        }
        if(isNaN(quantity)){
            alert("Please enter a valid quantity");
            return;
        }
        if(isNaN(category)){
            alert("Please enter a valid category");
            return;
        }
        const imageTest = /\.(jpe?g|png|gif|bmp)$/i;
        if(!imageTest.test(image)) {
            alert("Please enter a valid image");
            return;
        }

        const formData = new FormData();
        formData.append("name", name);
        formData.append("rate", rate);
        formData.append("price", price);
        formData.append("quantity", quantity);
        formData.append("description", description);
        formData.append("color", color);
        formData.append("material", material);
        formData.append("brand", brand);
        formData.append("category", category);
        formData.append("image", image);
        formData.append("request", "addProduct");

        const requestOptions = {
            method: "POST",
            Header: "Content-Type: multipart/form-data",
            body: formData
        };

        fetch("http://localhost:8080/controller/php/backOffice/backOfficeController.php", requestOptions)
        .then(response => response.json())
        .then(data => {
            if(data.status === "success") {
                alert("Product added successfully");
                productForm.style.display = "none";

            } else if(data.status === "error"){
                alert("Product already exists")
            }
        })
        .catch(error => 
            self.location = '/gt-admin?error=UnexpectedError'
        );
    });
    
    const deleteButtons = document.querySelectorAll('.bo_deleteProduct_button');
        
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.closest('.bo_tbody_tr').querySelector('#td_product_id').textContent;
            const imageId = this.closest('.bo_tbody_tr').querySelector('#td_image_id').textContent;
            const secondaryImageId = this.closest('.bo_tbody_tr').querySelector('#td_secondary_image_id').textContent;
            
            const formData = new FormData();
            formData.append("productId", productId);
            formData.append("imageId", imageId);
            formData.append("secondaryImageId", secondaryImageId);
            formData.append("request", "deleteProduct");

            const requestOptions = {
                method: "POST",
                Header: "Content-Type: multipart/form-data",
                body: formData
            };

            fetch("http://localhost:8080/controller/php/backOffice/backOfficeController.php", requestOptions)
            .then(response => response.json())
        });
    });
});