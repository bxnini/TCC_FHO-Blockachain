<?php
	require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport">
  <title>Blockchain Validator</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
  <link rel="shortcut icon" type="imagex/png" href="../images/block_icon.ico">
  <script src="https://kit.fontawesome.com/453729a97c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="input.css" />


  <style>
    .work-sans {
      font-family: 'Work Sans', sans-serif;
    }


    .hover\:grow {
      transition: all 0.3s;
      transform: scale(1);
    }

    .hover\:grow:hover {
      transform: scale(1.02);
    }
  </style>

</head>

<body class="bg-black">

  <!-- Nav Bar -->

  <nav id="header" class="w-full z-30 top-0 p-5 pt-7">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 ">
      <input class="hidden" type="checkbox" id="menu-toggle" />

      <div class="flex">
        <a class="flex items-center tracking-wide no-underline hover:no-underline text-white text-xl">
          <i class="fa-solid fa-cubes fa-xl pe-8 "></i>
          Validador de documentos - Blockchain
        </a>
      </div>

      <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
        <nav>
          <ul class="md:flex items-center justify-between text-base text-gray-700 pt-4 md:pt-0">
            <li><a class="inline-block no-underline text-white hover:text-slate-500 hover:no-underline py-2 px-4"
                href="#">Blockchain</a>
            </li>
            <li><a class="inline-block no-underline text-white hover:text-slate-500 hover:no-underline py-2 px-4"
                href="../src/login.html">Logout</a></li>
          </ul>
        </nav>
      </div>

    </div>
  </nav>
  <!-- End Nav Bar -->

  <!-- Banner -->
  <section class="w-full mx-auto bg-nordic-gray-light flex pt-12 md:pt-0 md:items-center bg-cover bg-right"
    style="max-width:2000px; height:20rem; background-image: url('https://images.unsplash.com/photo-1686425374911-e0d752e09806?auto=format&fit=crop&q=80&w=1493&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">

    <div class="container mx-auto">
      <div class="flex flex-col w-full lg:w-1/2 justify-center items-start  px-6 tracking-wide">
        <h1 class="text-white text-2xl my-4">Validação de documentos utilizando Blockchain</h1>
      </div>
    </div>

  </section>
  <!-- End Banner -->

  <div class="p-5">
    <div class="grid justify-items-start md:justify-items-center flex items-center justify-between mb-4">
      <h5 class="text-xl text-white font-bold leading-none">Documentos Upados</h5>
    </div>
  </div>

  <!--Principal Card-->

  <div class="p-5">
    <div class="p-8 rounded-lg bg-white text-center dark:bg-neutral-700">
      <div class="border-b-2 border-neutral-100 p-3 dark:border-neutral-600 dark:text-neutral-50">
        <!--Pills navigation-->
        <ul class="flex list-none flex-col flex-wrap pl-0 md:flex-row" data-te-nav-ref>
          <li role="presentation">
            <a class="text-bold">
              Arquivo</a>
          </li>
        </ul>
      </div>

      <div class='p-3 flex flex-wrap justify-center tracking-wide'>
      <table class="table  w-full">
				  <thead class='text-white bg-color-black'>
				    <tr class='flex-wrap w-full text-center'>
				      <th class='pr-8 pl-8' scope="col">ID <p></th>
				      <th class='pr-8 pl-8' scope="col">Hash Anterior </th>
				      <th class='pr-8 pl-8' scope="col">Descrição do Arquivo </th>
				      <th class='pr-8 pl-8' scope="col">Hash </th>
				      <th class='pr-8 ' scope="col">_____</th>
				    </tr>
				  </thead>
				  <tbody>
            <?php  
                  $pesquisa = "";
                  $stmt = $conn->prepare("SELECT * FROM blocks");
                  
                  
                  $stmt->execute();
                  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  
                  foreach($results as $row => $value){
                    echo "<tr>";
                    echo "<td>" . $value['id'] . "</td>";
                    echo "<td>" . $value['previousHash'] . "</td>";
                    echo "<td>" . $value['data'] . "</td>";
                    echo "<td>" . $value['hash'] . "</td>";
                    echo "<td class='flex'>                 
                      <a class='fa-solid fa-trash btn btn-sm btn-danger pl-4 text-red-600' href='exc.php?id =".$value['id']."'></a>
                    </td>";
                    echo "<tr>";
                  }
                ?>
            </tbody>
				</table>

        <div class="w-full" >
          <br>
          <div class="p-5 text-xl text-white font-bold leading-none">
            Documento
          </div>
        </div>


        <div class='w-full' id="pdfContainer">
          <!-- Aqui será incorporado o PDF -->
        </div>
        <br>

      </div>
    </div>

  </div>

  <!--End Principal Card-->

  <!--Spacer-->
  <div class="bg-black">
    <div class="p-12 bg-black">
    </div>
  </div>
  <!--End Spacer-->

  <!-- Inside Buttom -->

  <button class=" fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 bg-white border border-gray-200 rounded-full 
    bottom-4 left-1/2 bg-gradient-to-r from-indigo-900 via-purple-500 to-fuchsia-800 font-bold  text-white"
    onclick="my_modal_1.showModal()">Upload do Documentos</button>


  <!-- Card Content-->
  <div class="">
    <dialog id="my_modal_1" class="modal w-1/2">

      <div class="modal-box p-3  dark:bg-neutral-700 ">
        <div class="p-3 dark:border-neutral-600 dark:text-neutral-50">
          <p class="text-center pb-3">Submit Document to Blockchain</p>
          <div>
            <form action="PSOT">
              <p class="p-1 text-gray-400">Authorship</p>
              <input type="text" 
                class="mb-2 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">

              <p class="p-1 text-gray-400">Send Date</p>
              <div id="current_date"
                class="mb-2 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <script>
                  document.getElementById("current_date").innerHTML = Date();
                </script>
              </div>

              <p class="p-1 text-gray-400">Escolher Arquivo</p>
              <div>
                <input type="file" id="arquivo"
                class="block mb-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                <p class="mt-1 text-sm text-left text-gray-500 dark:text-gray-300">PDF, TXT, DOCX ou CSV.</p>
              </div>
            </from>
          </div>
        </div>

        <!--File send button-->
        <form class="pl-3 flex-wrap">
          <button id="envia"
            class="btn justify-end text-white bg-red-200 hover:bg-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-300 font-medium rounded-lg text-sm px-8 py-2.5 dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800">
            Submit</button>
        </form>
        <!--End file send button-->

        <form method="dialog" class="pt-3  flex-wrap">
          <!-- if there is a button in form, it will close the modal -->
          <button 
            class="btn  display text-white bg-red-200 hover:bg-red-200 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-8 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            Close &nbsp; </button>
        </form>


      </div>


    </dialog>
  </div>
  <!-- End Inside Buttom -->
  <!-- End Card Content -->
  </div>
  </div>

  <script src="../src/file.js"></script>

</body>

</html>