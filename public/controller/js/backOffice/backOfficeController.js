document.addEventListener('DOMContentLoaded', function() {
    
    const addProductBtn = document.getElementById("bo_button_addProduct");
    const productForm = document.getElementById("bo_formAddProduct");
    productForm.style.display = "none";

    const updateForm = document.getElementById('bo_formUpdateProductPreFill');
    updateForm.style.display = "none";

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
        let image = document.getElementById("images").value;
        let secondaryImage = document.getElementById("secondaryImages").value;
        if(secondaryImage === "") {
            secondaryImage = "none";
        }
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
        formData.append("secondaryImage", secondaryImage);
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
            const imageId = this.closest('.bo_tbody_tr').querySelector('#td_images_id').textContent;
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
            .catch(error =>
                console.log(error)
            );
        });
    });

    const updateButton = document.querySelectorAll('.bo_updateProduct_button');
    updateButton.forEach(button => {
        updateForm.style.display = "block";
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const addSecondaryImageBtn = document.getElementById('buttonAddImages');
            const modifyProductForm = document.getElementById('divAddNewImages');
            let newImageCount = 1;
            
            
            addSecondaryImageBtn.addEventListener('click', function(event) {
                event.preventDefault();

                let inputAddImages = document.createElement('input');
                
                inputAddImages.type = "text";
                inputAddImages.name = "addSecondaryImages";
                inputAddImages.id = "newSecondaryImages";
                inputAddImages.placeholder = "Ajouter une nouvelle image";
                
                modifyProductForm.appendChild(inputAddImages);
                
                newImageCount++;

                
               
            });
            // GET TABLE DATA
            const productId = this.closest('.bo_tbody_tr').querySelector('#td_product_id').textContent;
            const productName = this.closest('.bo_tbody_tr').querySelector('#td_product_name').textContent;
            const productRate = this.closest('.bo_tbody_tr').querySelector('#td_product_rate').textContent;
            const productPrice = this.closest('.bo_tbody_tr').querySelector('#td_product_price').textContent;
            const productQuantity = this.closest('.bo_tbody_tr').querySelector('#td_product_quantity').textContent;
            const productDescription = this.closest('.bo_tbody_tr').querySelector('#td_product_description').textContent;
            const productColor = this.closest('.bo_tbody_tr').querySelector('#td_product_color').textContent;
            const productMaterial = this.closest('.bo_tbody_tr').querySelector('#td_product_material').textContent;
            const productBrand = this.closest('.bo_tbody_tr').querySelector('#td_product_brand').textContent;
            const categoryName = this.closest('.bo_tbody_tr').querySelector('#td_category_name').textContent;
            const imageId = this.closest('.bo_tbody_tr').querySelector('#td_images_id').textContent;
            const imagePath = this.closest('.bo_tbody_tr').querySelector('#td_images_path').textContent;
            const secondaryImageId = this.closest('.bo_tbody_tr').querySelector('#td_secondary_images_id').textContent;
            const secondaryImagePath = this.closest('.bo_tbody_tr').querySelector('#td_secondary_images_path').textContent;

            // GET INPUT TO FILL
            let updateName = document.getElementById('updateName');
            let updateRate = document.getElementById('updateRate');
            let updatePrice = document.getElementById('updatePrice');
            let updateQuantity = document.getElementById('updateQuantity');
            let updateDescription = document.getElementById('updateDescription');
            let updateColor = document.getElementById('updateColor');
            let updateMaterial = document.getElementById('updateMaterial');
            let updateBrand = document.getElementById('updateBrand');
            let updateCategory = document.getElementById('updateCategory');
            let updateImagesId = document.getElementById('updateImagesId');
            let updateImages = document.getElementById('updateImages');
            let updateSecondaryImagesId = document.getElementById('updateSecondaryImagesId');
            let updateSecondaryImages = document.getElementById('updateSecondaryImages');
 
            // FILL INPUT
            updateName.value = productName;
            updateRate.value = productRate;
            updatePrice.value = productPrice;
            updateQuantity.value = productQuantity;
            updateDescription.value = productDescription;
            updateColor.value = productColor;
            updateMaterial.value = productMaterial;
            updateBrand.value = productBrand;
            updateCategory.value = categoryName;
            updateImagesId.value = imageId;
            updateImages.value = imagePath;
            updateSecondaryImagesId.value = secondaryImageId;
            updateSecondaryImages.value = secondaryImagePath;

            updateForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const newImages = document.querySelector('#newSecondaryImages');

                const formData = new FormData();
                formData.append('id', productId);
                formData.append('name', updateName.value);
                formData.append('rate', updateRate.value);
                formData.append('price', updatePrice.value);
                formData.append('quantity', updateQuantity.value);
                formData.append('description', updateDescription.value);
                formData.append('color', updateColor.value);
                formData.append('material', updateMaterial.value);
                formData.append('brand', updateBrand.value);
                formData.append('category_name', updateCategory.value);
                formData.append('image_id', updateImagesId.value)
                formData.append('image_path', updateImages.value);
                formData.append('secondary_image_id', updateSecondaryImagesId.value);
                formData.append('secondary_image_path', updateSecondaryImagesId.value);
                //formData.append('newImagesPath', newImages);
                //formData.append('newImages', 'true');
                formData.append('request', "updateProduct");

                
                
                const requestOptions = {
                    method: "POST",
                    Header: "Content-Type: multipart/form-data",
                    body: formData
                }
                
                fetch('http://localhost:8080/controller/php/backOffice/backOfficeController.php', requestOptions)
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        location.reload();
                    } else if (data.status === "error") {
                        if (data.message === "ProductAlreadyExist") {
                            alert("Product already exists");
                        } else if (data.message === "NameAlreadyExist") {
                            alert("Product name already exists");
                        } else if (data.message === "ProductNotUpdated") {
                            alert("Unexpected error");
                        } else if (data.message === "ImageAlreadyExist") {
                            alert("Image already exists");
                        } else if (data.message === "secondaryImageAlreadyExistInDataBase") {
                            alert("Secondary image already exists in the database");
                        } else if (data.message === "cannotAddMainImage") {
                            alert("Cannot add main image");
                        } else if (data.message === "SecondaryImageAlreadyExist") {
                            alert("Secondary image already exists");
                        }
                    }                 
                })
                .catch(error =>
                    console.log(error)
                )
            });
        });
    });
});