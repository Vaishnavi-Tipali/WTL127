<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Management</title>
  <style>
   body {
    font-family: Arial, sans-serif;
    background: #f9f9f9;
    padding: 20px;
}

form {
    background: #fff;
    padding: 15px;
    margin: 15px auto;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    max-width: 400px;
}

form h3, form h4 {
    margin-top: 0;
    color: #007BFF;
}

form label {
    display: block;
    margin: 8px 0 4px;
}

form input {
    width: 100%;
    padding: 6px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form button {
    background: #007BFF;
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 4px;
    cursor: pointer;
}
form button:hover {
    background: #0056b3;
}

#resultdiv {
    text-align: center;
    font-weight: bold;
    margin: 10px 0;
}

table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
table th, table td {
    padding: 10px;
    border: 1px solid #ddd;
}
table thead {
    background: #007BFF;
    color: #fff;
}

</style>

</head>
<body>
  <h2>Student Management System</h2>

<form id="createForm">
  <h3>Create Student</h3>
  <label>Name:</label>
  <input type="text" name="name" required>
  <label>Email:</label>
  <input type="email" name="email" required>
  <label>Age:</label>
  <input type="number" name="age" required>
  <button type="button" id="createBtn">Create</button>
</form>

<form id="checkUpdateForm">
  <h3>Update Student</h3>
  <label>Enter ID:</label>
  <input type="number" name="id" required>
  <button type="button" id="checkUpdateBtn">Check ID</button>
</form>

<form id="updateForm" style="display:none;">
  <h4>Update Details</h4>
  <input type="hidden" name="id">
  <label>Name:</label>
  <input type="text" name="name">
  <label>Email:</label>
  <input type="email" name="email">
  <label>Age:</label>
  <input type="number" name="age">
  <button type="button" id="updateBtn">Update</button>
</form>

<form id="deleteForm">
  <h3>Delete Student</h3>
  <label>Enter ID:</label>
  <input type="number" name="id" required>
  <button type="button" id="deleteBtn">Delete</button>
</form>

<div id="resultdiv"></div>

<button id="getBtn">Get All Students</button>
<table border="1">
  <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th></tr></thead>
  <tbody id="tbody1"></tbody>
</table>

<script>
   
document.getElementById("createBtn").addEventListener("click", async ()=>{
    let form = document.getElementById("createForm");
    let data = new FormData(form);
    let res = await fetch("create.php", {method:"POST", body:data});
    document.getElementById("resultdiv").textContent = await res.text();
    form.reset();
});


document.getElementById("getBtn").addEventListener("click", async ()=>{
    let res = await fetch("read.php");
    let data = await res.json();
    let tbody = document.getElementById("tbody1");
    tbody.innerHTML = "";
    for (let row of data){
        let tr = document.createElement("tr");
        tr.innerHTML = <td>${row.id}</td><td>${row.name}</td><td>${row.email}</td><td>${row.age}</td>;
        tbody.appendChild(tr);
    }
});


document.getElementById("deleteBtn").addEventListener("click", async ()=>{
    let form = document.getElementById("deleteForm");
    let data = new FormData(form);
    let res = await fetch("delete.php", {method:"POST", body:data});
    document.getElementById("resultdiv").textContent = await res.text();
    form.reset();
});


document.getElementById("checkUpdateBtn").addEventListener("click", async ()=>{
    let form = document.getElementById("checkUpdateForm");
    let data = new FormData(form);
    let res = await fetch("read.php", {method:"POST", body:data});
    let student = await res.json();

    if(student.exists){
        document.getElementById("updateForm").style.display="block";
        document.querySelector("#updateForm input[name=id]").value = student.id;
        document.querySelector("#updateForm input[name=name]").value = student.name;
        document.querySelector("#updateForm input[name=email]").value = student.email;
        document.querySelector("#updateForm input[name=age]").value = student.age;
    } 
    else {
        document.getElementById("resultdiv").textContent = "ID not found!";
    }
});


document.getElementById("updateBtn").addEventListener("click", async ()=>{
    let form = document.getElementById("updateForm");
    let data = new FormData(form);
    let res = await fetch("edit.php", {method:"POST", body:data});
    document.getElementById("resultdiv").textContent = await res.text();
    form.reset();
    document.getElementById("updateForm").style.display="none";
});
</script>
</body>
</html>