const url =
  "https://newsapi.org/v2/top-headlines?" +
  "country=us&" +
  "apiKey=1bf24020d57f4e60ad1dfdee34d16ee9";

async function fetchData() {
  try {
    const req = new Request(url);
    const response = await fetch(req);
    const data = await response.json(); // Espera pela promessa resolvida
    // console.log("Dados:", data);

    console.log("artigos;", data.articles[1]);
  } catch (error) {
    console.error("Erro ao buscar dados:", error);
  }
}

fetchData();
