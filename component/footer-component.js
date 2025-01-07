class FooterComponent extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `    <footer class="bg-white py-6 mt-12 border-t border-gray-200">
      <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-around items-center my-10">
        <div class="flex flex-col sm:flex-row mb-4 sm:mb-0">
          <div class="m-5 flex justify-center items-center hidden md:block">
            <img src="../img/logo_FH.png" alt="Fashion Hub Logo" class="h-14" />
          </div>
          <div class="m-5">
            <span class="text-xl sm:text-4xl font-bold">Fashion Hub</span>
            <p class="text-sm max-w-xs sm:max-w-md">
              kami selalu memberikan koleksi - koleksi terbaru dengan harga
              terjangkau dan pengiriman ke seluruh Indonesia
            </p>
          </div>
        </div>

        <div class="text-center">
          <div class="text-lg sm:text-xl">Temukan Kami</div>
          <div class="flex justify-center mt-3">
            <a href="https://instagram.com" class="px-2">
              <img src="../img/icon/instagram.png" alt="Instagram" class="h-6" />
            </a>
            <a href="https://facebook.com" class="px-2">
              <img src="../img/icon/facebook.png" alt="Facebook" class="h-6" />
            </a>
            <a href="https://twitter.com" class="px-2">
              <img src="../img/icon/twitter.png" alt="Twitter" class="h-6" />
            </a>
          </div>
        </div>
      </div>
    </footer>`;
  }
}
customElements.define("footer-component", FooterComponent);
