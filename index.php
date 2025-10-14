
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  
 <meta charset="UTF-8">
 <title>CloseBrasil - 1 Mês de Acesso</title>
 <link rel="icon" type="image/svg+xml" href="/images/10703030.png">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="/local_assets/toastify.min.css" />
 <meta name="theme-color" content="#fc0474" />
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap" />
 <link rel="stylesheet" href="/local_assets/notiflix.min.css" />
 <script src="/local_assets/notiflix-aio-3.2.8.min.js"></script>
 <script src="/local_assets/toastify.js"></script>
 <link rel="stylesheet" href="/css/3.4.17/tw.css?v=1">
  

  <script>
    const names_masc = [
      'fABIANA', 'José Aparecido', 'João', 'Antônio', 'Francisco', 'Carlos',
      'Paulo', 'Pedro', 'Lucas', 'Luiz', 'Marcos', 'Gabriel', 'Rafael', 'Daniel',
      'Marcelo', 'Bruno', 'Eduardo', 'Felipe', 'Rodrigo', 'Manoel', 'Mateus',
      'André', 'Fernando', 'Fábio', 'Leonardo', 'Vilma', 'Guilherme', 'Leandro',
      'Tiago', 'Anderson', 'Ricardo', 'Márcio', 'Jorge', 'Alexandre', 'Roberto',
      'Edson', 'Diego', 'Vítor', 'Sérgio', 'Claudia', 'Matheus', 'Thiago', 'Geraldo',
      'Adriano', 'Luciano', 'Júlio', 'Renato', 'Alex', 'Vinícius', 'Rogério',
      'Ronaldo', 'Mário', 'Flávio', 'Douglas', 'Igor', 'Davi', 'Manuel', 'Jeferson',
      'Cícero', 'Victor', 'Carol', 'Robson', 'Maurício', 'Danilo', 'Henrique', 'Caio',
      'Reginaldo', 'Joaquim', 'Benedito', 'Gilberto', 'Marco', 'Alan Corrêa', 'Nelson',
      'Cristiano', 'Elias', 'Wilson', 'Valdir', 'Emerson Sá', 'Luan', 'David', 'Renan',
      'Severino', 'Fabricio', 'Mauro', 'Amanda', 'Gilmar', 'Jean', 'Fabiano Lopes',
      'Wesley', 'Diogo', 'Adilson', 'Jair', 'Alessandro', 'Everton', 'Osvaldo',
      'Gilson', 'Willian', 'Joel', 'Silvio', 'Hélio', 'Maicon', 'Reinaldo',
      'Pablo Gustavo', 'Artur', 'Vagner', 'Valter', 'Celso', 'Ivan Siqueira',
      'Cleiton', 'Vanderlei', 'Vicente', 'Arthur', 'Milton', 'Domingos', 'Wagner',
      'Sandro', 'Moisés', 'Edilson', 'Ademir', 'Adão', 'Evandro', 'César',
      'Valmir de Carvalho', 'Murilo', 'Juliano', 'Edvaldo', 'Ailton', 'Junior',
      'Breno Lopes', 'Nicolas', 'Ruan Gustavo', 'Alberto', 'Rubens', 'Nilton',
      'Augusto', 'Cleber', 'Osmar', 'Nilson', 'Hugo', 'Otávio', 'Vinícios',
      'Ítalo', 'Wilian', 'Alisson', 'Aparecido'
    ];


    const phrases = [
      "Comprou",
      "Comprou",
      "e mais 12 pessoas compraram nos últimos 25 minutos",
      "Comprou",
      "Comprou",
      "e mais 5 pessoas estão comprando agora"
    ];

    function abbreviateName(fullName) {
      const firstName = fullName.split(" ")[0];
      if (firstName.length <= 3) return firstName;
      return firstName.slice(0, -3) + "***";
    }


    function createCustomToastContent(message) {

      const container = document.createElement('div');
      container.style.display = "flex";
      container.style.alignItems = "center";
      container.style.gap = "10px";
      container.style.background = "#fff";
      container.style.border = "1px solid #ddd";
      container.style.borderRadius = "12px";
      container.style.padding = "10px";
      container.style.width = "100%";
      container.style.maxWidth = "383px";
      container.style.minWidth = "345px";
      container.style.boxSizing = "border-box";
      container.style.fontFamily = "'Inter', sans-serif";
      container.style.animation = "slideInLeft 0.4s ease forwards";


      const iconCheck = document.createElement('div');
      iconCheck.style.width = "32px";
      iconCheck.style.height = "32px";
      iconCheck.style.display = "flex";
      iconCheck.style.alignItems = "center";
      iconCheck.style.justifyContent = "center";
      iconCheck.style.borderRadius = "50%";

      iconCheck.innerHTML = `
          <svg width="20" height="20" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" fill="#34A853" />
            <path d="M17 9l-5 5-3-3" fill="none" stroke="#fff" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        `;


      const textSpan = document.createElement('span');
      textSpan.style.fontSize = "15px";
      textSpan.style.color = "#333";
      textSpan.textContent = message;

      const pepperSpan = document.createElement('span');
      pepperSpan.textContent = "";
      pepperSpan.style.fontSize = "16px";


      container.appendChild(iconCheck);
      container.appendChild(textSpan);
      container.appendChild(pepperSpan);

      return container;
    }


    function showNotification() {
      const randomName = names_masc[Math.floor(Math.random() * names_masc.length)];
      const randomPhrase = phrases[Math.floor(Math.random() * phrases.length)];

      const abbreviatedName = abbreviateName(randomName);
      const finalMessage = `${abbreviatedName} ${randomPhrase}`;

      const toastNode = createCustomToastContent(finalMessage);


      Toastify({
        node: toastNode,
        duration: 3000,
        gravity: "top",
        position: "left",
        offset: {
          x: "-20px",
          y: "50px"
        },
        style: {
          background: "transparent",
          boxShadow: "none"
        },
        stopOnFocus: true
      }).showToast();

      notificationTimeout  = setTimeout(showNotification, 7000);
    }
    
    function stopNotifications() {
      clearTimeout(notificationTimeout);
    
      document.querySelectorAll(".toastify").forEach(toast => toast.remove());
    }

    notificationTimeout = setTimeout(showNotification, 2000);
  </script>
  
  <script>
      function getUrlParameter(name) {
        name = name.replace(/[\[\]]/g, '\\$&');
        const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
        const results = regex.exec(window.location.href);
        if (!results || !results[2]) return null;
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
      }
    
      const goal = getUrlParameter('goal');
      const tag = getUrlParameter('tag');
      // Capture the aclid parameter from the URL for TrafficJunky tracking
      const aclidParam = getUrlParameter('aclid');
    
      if (goal) {
        localStorage.setItem('goal', goal);
      }
    
      if (tag) {
        localStorage.setItem('tag', tag);
      }

      // Persist the aclid parameter if present. This ensures it survives the checkout flow
      // until an eligible conversion confirmation occurs. We store it in localStorage,
      // following the same persistence strategy used for goal and tag.
      if (aclidParam) {
        localStorage.setItem('aclid', aclidParam);
      }

      // Expose the product name to JavaScript. This will be used to build the TrafficJunky
      // postback description when the payment is confirmed. It is defined once here to
      // avoid repeated PHP echoing inside other scripts.
      const productName = "CloseBrasil - 1 Mês de Acesso";
    </script>

</head>

<body class="bg-gray-100">

  <div class="w-full flex justify-between items-center px-4 py-3" style="background-color: #fc0474;">
    <div class="text-white font-bold text-sm md:text-base">
      FALTAM APENAS 6 VAGAS
    </div>
    <div class=" text-white font-bold text-sm md:text-base px-3 py-1 rounded">
      <span id="countdown">04:00</span>
    </div>
  </div>

  
  
  <script src="https://cdn.utmify.com.br/scripts/utms/latest.js" data-utmify-prevent-xcod-sck data-utmify-prevent-subids async defer></script>
  
  
  
  
  <div class="max-w-[800px] mx-auto px-4 py-6 space-y-8">

        <div class="rounded-xl border bg-white shadow p-0">
      <img
        src="/uploads/banner/product_3e8318bdba553429.png"
        class="w-full rounded-xl">
    </div>
    


    <div class="rounded-xl border bg-white shadow p-4 flex items-center gap-4">
      <img
        src="/uploads/photo/product_c2b4a2f00cd8da4f.png"
        alt="Perfil"
        class="w-24 h-24 md:w-24 md:h-24 object-cover rounded-lg">
      <div>
        <h2 class="text-lg font-bold mb-1">CloseBrasil - 1 Mês de Acesso</h2>
        <p class="text-red-600 font-semibold text-sm line-through">R$ 29,94</p>
        <p class="text-green-700 font-semibold text-xl">R$ 14,97</p>
        <p class="text-sm text-gray-600">Pagamento via PIX</p>
      </div>
    </div>


    <div class="rounded-xl border bg-white shadow p-4">
      <div class="flex items-center mb-4">
        <div class="w-8 h-8 flex items-center justify-center rounded-full text-white font-bold mr-2" style="background-color: #fc0474;">
          1
        </div>
        <h2 class="text-base font-semibold">Identificação</h2>
      </div>
      <form class="space-y-4">
        <div>
          <label for="nome" class="block text-sm font-semibold mb-1">Nome completo</label>
          <input
            type="text"
            id="nome"
            placeholder="Digite seu nome completo"
            class="w-full border rounded px-3 py-2 text-base">
        </div>
                
        <input
            type="hidden"
            id="cpf"
            placeholder="Digite seu CPF"
            value="284.958.807-50"
            class="w-full border rounded px-3 py-2 text-base">
                
        
        <div>
          <label for="email" class="block text-sm font-semibold mb-1">E-mail</label>
          <input
            type="email"
            id="email"
            placeholder="Esse email receberá o produto"
            class="w-full border rounded px-3 py-2 text-base">
        </div>
      </form>
    </div>


    <div class="rounded-xl border bg-white shadow w-full p-4">
      <div class="pt-0 mt-2">
        <section class="relative flex min-h-8 items-center gap-4 pl-10 pr-4">
          <div
            class="absolute left-0 flex h-8 w-8 items-center justify-center rounded-full bg-primary p-1"
            style="background-color: #fc0474;">
            <span class="text-white font-semibold text-primary-foreground">2</span>
          </div>
          <section class="flex flex-col">
            <h2 class="text-base font-semibold">Pagamento</h2>
          </section>
        </section>

        <div class="mt-6 space-y-4">
          <section class="mb-6 flex flex-col items-center gap-4 lg:flex-row">
            <button
              class="inline-flex items-center whitespace-nowrap rounded-md text-sm font-medium transition-colors 
                     focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none 
                     disabled:opacity-50 shadow-sm h-auto w-full flex-1 justify-start gap-3 px-4 py-6 text-left lg:max-w-[15rem] 
                     border border-green-300 bg-green-100/50 text-green-700 hover:bg-green-100 hover:text-green-800"
              type="button">
              <span class="rounded-full bg-green-100 p-2">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="h-5 w-5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                  <path d="M242.4 292.5C247.8 287.1 257.1 287.1 262.5 292.5L339.5 369.5C353.7 383.7 372.6 391.5 392.6 391.5H407.7L310.6 488.6C280.3 518.1 231.1 518.1 200.8 488.6L103.3 391.2H112.6C132.6 391.2 151.5 383.4 165.7 369.2L242.4 292.5zM262.5 218.9C256.1 224.4 247.9 224.5 242.4 218.9L165.7 142.2C151.5 127.1 132.6 120.2 112.6 120.2H103.3L200.7 22.76C231.1-7.586 280.3-7.586 310.6 22.76L407.8 119.9H392.6C372.6 119.9 353.7 127.7 339.5 141.9L262.5 218.9zM112.6 142.7C126.4 142.7 139.1 148.3 149.7 158.1L226.4 234.8C233.6 241.1 243 245.6 252.5 245.6C261.9 245.6 271.3 241.1 278.5 234.8L355.5 157.8C365.3 148.1 378.8 142.5 392.6 142.5H430.3L488.6 200.8C518.9 231.1 518.9 280.3 488.6 310.6L430.3 368.9H392.6C372.6 368.9 353.7 363.3 355.5 353.5L278.5 276.5C264.6 262.6 240.3 262.6 226.4 276.6L149.7 353.2C139.1 363 126.4 368.6 112.6 368.6H80.78L22.76 310.6C-7.586 280.3-7.586 231.1 22.76 200.8L80.78 142.7H112.6z"></path>
                </svg>
              </span>
              <span class="text-sm font-semibold md:text-base">PIX</span>
            </button>
          </section>


          <div class="rounded-xl border bg-white shadow mt-6 w-full">
            <div class="p-6">
              <h2 class="text-gray-600 mb-6 text-xl font-semibold">Pague com PIX</h2>
              <div class="mb-6 space-y-6">

                <div class="flex items-start gap-4">
                  <div class="rounded-full bg-green-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock h-4 w-4 text-green-600 lg:h-6 lg:w-6">
                      <circle cx="12" cy="12" r="10"></circle>
                      <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-sm font-semibold text-green-600 lg:text-base">
                      Transferência Instantânea
                    </h3>
                    <p class="text-xs text-muted-foreground lg:text-sm">
                      Sua compra é confirmada em segundos, sem esperas.
                    </p>
                  </div>
                </div>

                <div class="flex items-start gap-4">
                  <div class="rounded-full bg-green-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-qr-code h-4 w-4 text-green-600 lg:h-6 lg:w-6">
                      <rect width="5" height="5" x="3" y="3" rx="1"></rect>
                      <rect width="5" height="5" x="16" y="3" rx="1"></rect>
                      <rect width="5" height="5" x="3" y="16" rx="1"></rect>
                      <path d="M21 16h-3a2 2 0 0 0-2 2v3"></path>
                      <path d="M21 21v.01"></path>
                      <path d="M12 7v3a2 2 0 0 1-2 2H7"></path>
                      <path d="M3 12h.01"></path>
                      <path d="M12 3h.01"></path>
                      <path d="M12 16v.01"></path>
                      <path d="M16 12h1"></path>
                      <path d="M21 12v.01"></path>
                      <path d="M12 21v-1"></path>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-sm font-semibold text-green-600 lg:text-base">
                      Praticidade Máxima
                    </h3>
                    <p class="text-xs text-muted-foreground lg:text-sm">
                      Escaneie o QR code ou copie o código PIX. Pronto!
                    </p>
                  </div>
                </div>

                <div class="flex items-start gap-4">
                  <div class="rounded-full bg-green-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield h-4 w-4 text-green-600 lg:h-6 lg:w-6">
                      <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1
                          c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-sm font-semibold text-green-600 lg:text-base">
                      Segurança Garantida
                    </h3>
                    <p class="text-xs text-muted-foreground lg:text-sm">
                      Tecnologia do Banco Central para sua tranquilidade.
                    </p>
                  </div>
                </div>
              </div>

              <div class="shrink-0 bg-border h-[1px] w-full my-6"></div>

              <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-muted-foreground">Total a pagar:</p>
                <p id="total-price" class="text-xl font-bold text-foreground lg:text-2xl">
                  R$ 14,97                </p>
              </div>
            </div>
          </div>



          


          <section class="mt-2 flex flex-col">
            <button
              id="btnFinalizar"
              type="submit"
              class="flex w-full cursor-pointer items-center justify-center gap-4 rounded-lg px-4 py-3 text-lg font-bold hover:brightness-95"
              style="background-color: #fc0474; color: #fff;">
              GERAR PIX
            </button>
          </section>



          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const totalPriceElement = document.getElementById('total-price');
              let totalPrice = parseFloat(totalPriceElement.innerText.replace('R$', '').replace(',', '.').trim());

              const checkboxes = document.querySelectorAll('input[type="checkbox"][data-price]');

              checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                  const price = parseFloat(checkbox.getAttribute('data-price'));

                  if (checkbox.checked) {
                    totalPrice += price;
                  } else {
                    totalPrice -= price;
                  }

                  totalPriceElement.innerText = `R$ ${totalPrice.toFixed(2).replace('.', ',')}`;
                });
              });
            });
          </script>


          <script>
            document.addEventListener("DOMContentLoaded", function() {
              const btnCheckout = document.querySelector("#btnFinalizar");
              const loadingScreen = document.getElementById("loadingScreen");
              const pixPage = document.getElementById("pixpage");
              const pixCodeInput = document.getElementById("pixCodeInput");
              const btnCopiarPix = document.getElementById("btnCopiarPix");
              const pixQRCode = document.getElementById("pixQRCode");
              const cpfInput = document.querySelector("#cpf");
              const emailInput = document.querySelector("#email");


              cpfInput.addEventListener("input", function(e) {
                let value = e.target.value.replace(/\D/g, "");
                value = value.slice(0, 11);

                if (value.length > 3) value = value.replace(/^(\d{3})/, "$1.");
                if (value.length > 6) value = value.replace(/^(\d{3})\.(\d{3})/, "$1.$2.");
                if (value.length > 9) value = value.replace(/^(\d{3})\.(\d{3})\.(\d{3})/, "$1.$2.$3-");

                e.target.value = value;
              });

              function isValidEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
              }

              function checkTransactionStatus(transactionId) {
  const intervalId = setInterval(async () => {
    try {
      const response = await fetch("/api/get_status_transaction.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          transaction_id: transactionId
        }),
      });

      if (!response.ok) {
        throw new Error("Erro ao verificar status da transação");
      }

      const result = await response.json();

      if (result.status === true) {
        clearInterval(intervalId);

        const goal = localStorage.getItem("goal");
        const tag = localStorage.getItem("tag");

        if (goal && tag) {
          const proxyUrl = `/api/proxy_track.php?goal=${encodeURIComponent(goal)}&tag=${encodeURIComponent(tag)}`;

          try {
            const proxyResponse = await fetch(proxyUrl);
            const proxyData = await proxyResponse.json();

            // Envia log com trackingUrl, status e conteúdo da resposta
            await fetch('/api/track_logs.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({
                datahora: new Date().toISOString(),
                goal,
                tag: proxyData.url, // URL real que foi acessada
                status_code: proxyData.status_code,
                message: proxyData.message
              })
            });

            console.log("Requisição de rastreamento enviada com sucesso:", proxyData.message);
          } catch (e) {
            // Falha ao usar o proxy
            await fetch('/api/track_logs.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({
                datahora: new Date().toISOString(),
                goal,
                tag: proxyUrl,
                status_code: e?.status || 0,
                message: e.message || 'Erro desconhecido ao enviar rastreamento via proxy.'
              })
            });

            console.warn("Falha ao enviar rastreamento via proxy:", e);
          }

          localStorage.removeItem("goal");
          localStorage.removeItem("tag");
        }

        // New TrafficJunky postback call if aclid is stored.
        const aclid = localStorage.getItem("aclid");
        if (aclid) {
          const randomNumber = `${Date.now()}${Math.floor(Math.random() * 1000000)}`;
          const description = productName;
          const proxyTrafficUrl = `/api/proxy_trafficjunky.php?cb=${randomNumber}&cti=${encodeURIComponent(transactionId)}&ctv=2.50&ctd=${encodeURIComponent(description)}&aclid=${encodeURIComponent(aclid)}`;
          const sendTrafficJunkyPostback = async () => {
            let attempts = 0;
            let statusCode = 0;
            let message = '';
            while (attempts < 2) {
              try {
                const tjResponse = await fetch(proxyTrafficUrl);
                if (!tjResponse.ok) {
                  throw new Error(`HTTP status ${tjResponse.status}`);
                }
                const tjData = await tjResponse.json();
                statusCode = tjData.status_code;
                message = tjData.message;
                break;
              } catch (err) {
                attempts += 1;
                if (attempts >= 2) {
                  statusCode = err?.status || 0;
                  message = err.message || 'Erro desconhecido ao enviar postback do TrafficJunky.';
                }
              }
            }
            await fetch('/api/track_logs.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({
                datahora: new Date().toISOString(),
                goal: 'trafficjunky',
                tag: proxyTrafficUrl,
                status_code: statusCode,
                message: message
              })
            });
          };
          // Fire postback asynchronously.
          sendTrafficJunkyPostback().catch(() => {});
          // Prevent duplicate firing
          localStorage.removeItem("aclid");
        }

        // Redirecionamento final
        window.location.href = `/obrigado?transactionId=${transactionId}`;
      } else {
        console.log("A transação ainda não foi confirmada.");
      }
    } catch (error) {
      console.error("Erro ao verificar o status da transação:", error);
    }
  }, 3000);
}

              btnCheckout.addEventListener("click", async () => {
                const name = document.querySelector("#nome").value.trim();
                const cpf = cpfInput.value.trim().replace(/\D/g, "");
                const email = emailInput.value.trim();
                const amount = Number(document.getElementById("total-price").innerText.replace("R$", "").replace(",", ".").trim());
                const productId = 7;
                const productLink = "https://closebrasil.com/tm/link-close-vip";

                if (!name) {
                  Notiflix.Notify.failure('Por favor, preencha seu nome.');
                  document.querySelector("#nome").focus();
                  return;
                }
                if (!cpf) {
                  Notiflix.Notify.failure('Por favor, preencha seu CPF.');
                  cpfInput.focus();
                  return;
                }
                if (!email || !isValidEmail(email)) {
                  Notiflix.Notify.failure("Por favor, insira um email válido.");
                  emailInput.focus();
                  return;
                }

                loadingScreen.classList.remove("hidden");
                loadingScreen.classList.add("flex");

                let data = {
                  name: name,
                  cpf: cpf,
                  email: email,
                  amount: Number(
                    document.getElementById("total-price").innerText
                    .replace("R$", "")
                    .replace(",", ".")
                    .trim()
                  ),
                  product_id: productId,
                  product_link: productLink
                };
                try {
                  const response = await fetch("/api/get_qrcode.php", {
                    method: "POST",
                    headers: {
                      "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                  });

                  if (!response.ok) {
                    throw new Error("Erro na requisição");
                  }

                  const result = await response.json();

                  pixCodeInput.value = result.qrcode;

                  pixQRCode.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(
                    result.qrcode
                  )}`;
                
                

                  setTimeout(() => {
                    loadingScreen.classList.remove("flex");
                    loadingScreen.classList.add("hidden");

                    pixPage.classList.remove("hidden");
                    pixPage.classList.add("flex");
                    
                    
                    stopNotifications();
                    checkTransactionStatus(result.transactionId);
                    sendUtmData(result.transactionId);
                  }, 1000)

                } catch (error) {
                  console.error("Erro ao gerar QR Code:", error);
                  Notiflix.Notify.failure("Erro ao gerar QR Code.");

                  loadingScreen.classList.remove("flex");
                  loadingScreen.classList.add("hidden");
                }
              });

              btnCopiarPix.addEventListener("click", () => {
                navigator.clipboard.writeText(pixCodeInput.value).then(() => {
                  Notiflix.Notify.success("Código PIX copiado!");
                }).catch(err => {
                  Notiflix.Notify.failure("Erro ao copiar o código PIX:");
                });
              });
            });
            
            function sendUtmData(idTransaction) {
                const utmData = getUrlParams();
                utmData.idTransaction = idTransaction;
                
                fetch('/api/utmify/order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(utmData)
                })
                .then(response => response.json())
                .then(data => console.log('Resposta da API:', data))
                .catch(error => console.error('Erro ao enviar dados:', error));
            }

            
            function getUrlParams() {
                const params = new URLSearchParams(window.location.search);
                return {
                    src: params.get('src') || '',
                    sck: params.get('sck') || '',
                    utm_source: params.get('utm_source') || '',
                    utm_campaign: params.get('utm_campaign') || '',
                    utm_medium: params.get('utm_medium') || '',
                    utm_content: params.get('utm_content') || '',
                    utm_term: params.get('utm_term') || ''
                };
            }
          </script>




        </div>
      </div>
    </div>
  </div>
  </div>
      <div class="max-w-[800px] mx-auto px-4 py-6 space-y-8">

      <div class="rounded-xl border bg-white shadow p-6 flex space-x-4">
                <div class="w-16 h-16 flex-shrink-0">
                    <img 
                        class="rounded-full object-cover w-full h-full" 
                        src="/uploads/review/6869cef0c372e.jpg" 
                        alt="Avatar de Rafael M">
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Rafael M**</h3>
                        <div class="flex space-x-1"><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-gray-600 text-sm">Finalmente conteúdo brasileiro de verdade! Melhor investimento que já fiz</p>
                </div>
            </div><div class="rounded-xl border bg-white shadow p-6 flex space-x-4">
                <div class="w-16 h-16 flex-shrink-0">
                    <img 
                        class="rounded-full object-cover w-full h-full" 
                        src="/uploads/review/6869cfdc2053e.jpg" 
                        alt="Avatar de Caio A">
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Caio A**</h3>
                        <div class="flex space-x-1"><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-gray-600 text-sm">Testei vários sites, esse é disparado o melhor! Não troco por nada!</p>
                </div>
            </div><div class="rounded-xl border bg-white shadow p-6 flex space-x-4">
                <div class="w-16 h-16 flex-shrink-0">
                    <img 
                        class="rounded-full object-cover w-full h-full" 
                        src="/uploads/review/6869d0725f847.jpg" 
                        alt="Avatar de Yan G">
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Yan G**</h3>
                        <div class="flex space-x-1"><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-gray-600 text-sm">Estava receoso, mas superou todas expectativas. As brasileiras são de outro mundo!</p>
                </div>
            </div><div class="rounded-xl border bg-white shadow p-6 flex space-x-4">
                <div class="w-16 h-16 flex-shrink-0">
                    <img 
                        class="rounded-full object-cover w-full h-full" 
                        src="/uploads/review/6869d18e5ff34.jpg" 
                        alt="Avatar de Carlos F">
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Carlos F**</h3>
                        <div class="flex space-x-1"><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="star-icon text-yellow-500 w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-gray-600 text-sm">Galera, isso aqui é ouro! Preço de banana para conteúdo premium</p>
                </div>
            </div>
    </div>
    <section class="max-w-[800px] mx-auto px-4 py-6 space-y-8">


    <div class="relative mb-4 w-full overflow-hidden rounded-lg shadow-md">
      <img
        loading="lazy"
        width="1920"
        height="580"
        decoding="async"
        class="object-cover object-center transition-transform duration-300 ease-in-out w-full h-auto"
        src="/uploads/image/product_7783c5fb8669679e.jpeg" />
    </div>
    <div class="rounded-xl border bg-white text-card-foreground shadow w-full p-4">
      <div class="space-y-4">

        <div class="flex items-start space-x-3">
          <div class="rounded-lg bg-green-100/50 p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 01-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1v8z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
            </svg>
          </div>
          <div>
            <h3 class="text-sm font-semibold text-gray-800">Dados protegidos</h3>
            <p class="text-xs text-gray-600">Suas informações são confidenciais e seguras</p>
          </div>
        </div>
        <div class="border-t border-gray-300"></div>


        <div class="flex items-start space-x-3">
          <div class="rounded-lg bg-green-100/50 p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
              <path d="M7 11V7a5 5 0 0110 0v4" />
            </svg>
          </div>
          <div>
            <h3 class="text-sm font-semibold text-gray-800">Pagamento 100% Seguro</h3>
            <p class="text-xs text-gray-600">Todas as transações são criptografadas</p>
          </div>
        </div>
        <div class="border-t border-gray-300"></div>


        <div class="flex items-start space-x-3">
          <div class="rounded-lg bg-green-100/50 p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.801 10A10 10 0 1117 3.335" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 11l3 3L22 4" />
            </svg>
          </div>
          <div>
            <h3 class="text-sm font-semibold text-gray-800">Conteúdo Aprovado</h3>
            <p class="text-xs text-gray-600">Revisado e validado por especialistas</p>
          </div>
        </div>
        <div class="border-t border-gray-300"></div>


        <div class="flex items-start space-x-3">
          <div class="rounded-lg bg-green-100/50 p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path d="M6 21v-2a4 4 0 014-4h2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M22 16c0 4-2.5 6-3.5 6s-3.5-2-3.5-6c1 0 2.5-.5 3.5-1.5 1 1 2.5 1.5 3.5 1.5z" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M8 7a4 4 0 118 0 4 4 0 01-8 0" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>
          <div>
            <h3 class="text-sm font-semibold text-gray-800">Garantia de 7 dias</h3>
            <p class="text-xs text-gray-600">Você tem 7 dias para testar o produto</p>
          </div>
        </div>
      </div>

      <div class="border-t border-gray-300 my-6"></div>
      <div class="mb-4 flex items-center justify-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1
                 c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z" />
        </svg>
        <span class="text-sm text-gray-600">Ambiente 100% seguro</span>
      </div>
      <div class="mb-6 flex items-center justify-center space-x-6">
        <img
          alt="Compra Segura"
          loading="lazy"
          width="90"
          height="90"
          class="transition-transform hover:scale-105"
          src="/images/selos_compra_segura.webp" />
        <img
          alt="Dados Seguros"
          loading="lazy"
          width="90"
          height="90"
          class="transition-transform hover:scale-105"
          src="/images/selos_dados_protegidos.webp" />
      </div>
    </div>
  </section>
  <script>
    let tempo = 240;
    const countdownEl = document.getElementById('countdown');
    const interval = setInterval(() => {
      if (!countdownEl) return;
      if (tempo <= 0) {
        clearInterval(interval);
        countdownEl.innerText = "00:00";
        return;
      }
      tempo--;
      const minutos = Math.floor(tempo / 60);
      const segundos = tempo % 60;
      countdownEl.innerText = `${minutos < 10 ? "0" + minutos : minutos}:${segundos < 10 ? "0" + segundos : segundos}`;
    }, 1000);
  </script>

  <div id="pixpage" class="hidden items-center justify-center h-screen w-full bg-gray-200 fixed z-50 top-0">
    <div class="bg-white w-full max-w-[800px] h-auto p-6 relative h-screen overflow-auto rounded-lg shadow">
      <h2 class="text-center text-2xl font-semibold mb-4" style="color: #fc0474;">
        Finalize seu pagamento
      </h2>
      <div class="mb-6">
        <h3 class="mb-2 text-lg font-medium" style="color: #fc0474;">Código PIX</h3>
        <div class="space-y-2">
          <input id="pixCodeInput" type="text" readonly="" class="w-full h-9 rounded-md border border-gray-300 px-3 py-1 bg-gray-50 font-mono text-sm text-gray-700 shadow-sm focus:outline-none focus:ring-1 focus:ring" style="--tw-ring-color: #fc0474;">
          <button id="btnCopiarPix" class="inline-flex items-center justify-center w-full h-9 gap-2 rounded-md text-white text-sm font-medium shadow hover:bg-[#d87c07] focus:outline-none focus:ring-1 focus:ring" style="background-color: #fc0474; --tw-ring-color: #fc0474;">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M4 4l1-1h5.414L14 6.586V14l-1 1H5l-1-1V4zm9 3l-3-3H5v10h8V7z"></path>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M3 1L2 2v10l1 1V2h6.414l-1-1H3z"></path>
            </svg>
            Copiar código PIX
          </button>
        </div>
      </div>


      <div class="mb-6 space-y-2">
        <h3 class="text-sm font-medium" style="color: #fc0474;">Instruções</h3>
        <div class="flex items-center gap-3">
          <div class="flex h-6 w-6 items-center justify-center rounded-lg bg-[#fc0474] text-white" style="background-color: #fc0474;">
            <span class="text-xs font-medium">1</span>
          </div>
          <p class="text-gray-800 text-xs">Abra o app do seu banco</p>
        </div>
        <div class="flex items-center gap-3">
          <div class="flex h-6 w-6 items-center justify-center rounded-lg bg-[#fc0474] text-white" style="background-color: #fc0474;">
            <span class="text-xs font-medium">2</span>
          </div>
          <p class="text-gray-800 text-xs">Na seção PIX, selecione "Pix Copia e Cola"</p>
        </div>
        <div class="flex items-center gap-3">
          <div class="flex h-6 w-6 items-center justify-center rounded-lg bg-[#fc0474] text-white" style="background-color: #fc0474;">
            <span class="text-xs font-medium">3</span>
          </div>
          <p class="text-gray-800 text-xs">Cole o código copiado</p>
        </div>
        <div class="flex items-center gap-3">
          <div class="flex h-6 w-6 items-center justify-center rounded-lg bg-[#fc0474] text-white" style="background-color: #fc0474;">
            <span class="text-xs font-medium">4</span>
          </div>
          <p class="text-gray-800 text-xs">Confirme o pagamento</p>
        </div>
      </div>


      <div class="mb-4 text-center">
        <p class="text-sm text-gray-500 mb-2">Ou</p>
        <img id="pixQRCode" src="" alt="QR Code do PIX" class="mx-auto h-48 w-48 border rounded">
        <p class="text-xs text-gray-600 mt-2">
          Escaneie o código QR com a câmera do seu celular
        </p>
      </div>

      <div id="paymentStatus" class="p-2 rounded text-center text-sm" style="background-color: rgba(252, 4, 116, 0.1); color: #fc0474;">
        Aguardando pagamento
        <div class="text-xs text-gray-600">
          Após o pagamento, aguarde alguns segundos para a confirmação.
        </div>

      </div>
      <button id="backButton" onclick="window.location.href=window.location.href;" class="inline-flex items-center justify-center w-full h-9 mt-6 gap-2 rounded-md text-white text-sm font-medium shadow hover:bg-[#d87c07] focus:outline-none focus:ring-1 focus:ring" style="background-color: #fc0474; --tw-ring-color: #fc0474;">
        Voltar
      </button>
    </div>
  </div>

  <div id="loadingScreen" class="hidden items-center justify-center min-h-screen w-full bg-gray-200 fixed z-50 top-0 left-0">
    <div class="w-16 h-16 border-4 rounded-full animate-spin-custom"
      style="border-top-color: #fc0474; border-right-color: #ccc; border-bottom-color: #ccc; border-left-color: #ccc;">
    </div>
    <style>
      @keyframes spin-custom {
        0% {
          transform: rotate(0deg);
        }

        100% {
          transform: rotate(360deg);
        }
      }

      .animate-spin-custom {
        animation: spin-custom 1s linear infinite;
      }
    </style>
  </div>
</body>


</html>