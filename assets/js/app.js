document.addEventListener("DOMContentLoaded", () => {
  const buyBtn = document.getElementById("buyBtn");
  if (!buyBtn) return;

  buyBtn.addEventListener("click", event => {
    event.preventDefault();
    const gameId = buyBtn.dataset.gameId;

    fetch(`/api/games/buy/${gameId}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Authorization": "Bearer " + localStorage.getItem("token")
      }
    })
    .then(res => res.json())
    .then(json => {
      if (json.success) {
     
        const popup = document.createElement("div");
        popup.innerText = "Compra realizada com sucesso!";
        popup.style.position = "fixed";
        popup.style.top = "20px";
        popup.style.right = "20px";
        popup.style.background = "#27ae60";
        popup.style.color = "#fff";
        popup.style.padding = "1rem";
        popup.style.borderRadius = "5px";
        document.body.appendChild(popup);
        setTimeout(() => popup.remove(), 3000);
      } else {
        alert("Erro: " + (json.error || "Não foi possível processar a compra."));
      }
    })
    .catch(err => alert("Erro de rede: " + err.message));
  });
});
