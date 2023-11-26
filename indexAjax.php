<!--
Copyright amir javanmir
Released on: october 25, 2023
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File with XMLHttpRequest</title>
    <link rel="stylesheet" type="text/css" href="./assets/bootstrap.min.css" />
    <script src="./assets/axios.min.js"></script>
</head>
<body>
    <div class="container">
        <form method="post" action="<?= htmlspecialchars("http://".dirname($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]).'/upload.php');?>" enctype="multipart/form-data" class="py-4" id="form-upload">
            <div class="mb-3">
                <label for="file" class="form-label">select file</label>
                <input type="file" name="file" class="form-control" />
            </div>
            <div class="mb-3">
                <input type="submit" name="send" value="upload" class="btn btn-success">
            </div>
        </form>
        <div class="progress mt-3 d-none" id="progress">
            <div class="progress-bar" style="width:0%">0%</div>
        </div>
    </div>
    <script src="./assets/bootstrap.min.js"></script>
    <script>
        let form = document.querySelector("#form-upload");
        let progress = document.getElementById("progress");
        let progressBar = progress.querySelector(".progress-bar");
        form.addEventListener("submit", function(e){
            e.preventDefault();
            let file = this.querySelector(`input[name="file"]`).files[0];
            if(file){
                let ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress",function (load) {
                    progress.classList.remove("d-none");
                    let precent = Math.round(100 / (load.total / load.loaded));
                    progressBar.style.width = `${precent}%`;
                    progressBar.innerHTML = `${precent}%`;
                })
                
                let formData = new FormData();
                formData.append("file", file);
                ajax.open("POST", "upload.php");
                ajax.send(formData);

                ajax.addEventListener("load",completeHandler);
                function completeHandler(data){
                    if(this.responseText == "true"){
                        window.location.reload()
                    }
                }
            }else{
                alert("Not Selected File!");
            }
        })
    </script>
</body>
</html>
