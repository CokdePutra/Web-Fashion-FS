class NavComponent extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `<nav class="bg-white flex items-center justify-between py-4 px-8 mb-10">
      <!-- Responsive menu button for mobile -->
      <button
        id="menu-btn"
        class="md:hidden text-gray-500 hover:text-gray-700 focus:text-gray-700 focus:outline-none">
        <svg
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <!-- Dropdown Menu -->
      <div
        id="menu"
        class="hidden absolute bg-white shadow-md flex-col items-start py-2 top-0 left-0 rounded-lg space-y-2 px-4 w-full md:w-auto z-50">
        <a
          href="../pages/pakaian.html"
          class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 w-full"
          >Pakaian</a
        >
        <a
          href="../pages/aksesoris.html"
          class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 w-full"
          >Aksesoris</a
        >
        <button class="p-2 rounded-full hover:bg-gray-100" onclick="window.location.href='../user/profile.html'">
          <img src="/img/icon/profile.png" alt="Account" class="h-6" />
        </button>
        <button class="p-2 rounded-full hover:bg-gray-100" onclick="window.location.href='../cart/cart.html'">
          <img src="/img/icon/cart.png" alt="Cart" class="h-6" />
        </button>
      </div>
      <!-- Links Section -->
      <div class="flex items-center space-x-4 hidden md:block">
        <a href="../pages/pakaian.html" class="text-l uppercase hover:text-gray-500">Pakaian</a>
        <a href="../pages/aksesoris.html" class="text-l uppercase hover:text-gray-500">Aksesoris</a>
      </div>

      <!-- Logo Section -->
      <div class="text-3xl md:text-4xl" onclick="window.location.href='../home/homes.html'">
        <img src="/img/logo_FH.png" alt="FH" class="h-8 inline-block mr-2" />
        Fashion Hub
      </div>

      <!-- Icon and Login/Register Section -->
      <div class="flex items-center space-x-4 hidden md:block">
        <button class="p-2 rounded-full hover:bg-gray-100">
          <img src="/img/icon/search.png" alt="Search" class="h-6" />
        </button>
        <button class="p-2 rounded-full hover:bg-gray-100" onclick="window.location.href='../user/profile.html'">
          <img src="/img/icon/profile.png" alt="Account" class="h-6" />
        </button>
        <button class="p-2 rounded-full hover:bg-gray-100" onclick="window.location.href='../cart/cart.html'">
          <img src="/img/icon/cart.png" alt="Cart" class="h-6" />
        </button>
      </div>
    </nav>`;

    // Set up event listeners
    this.querySelector("#menu-btn").addEventListener("click", () => {
      const dropdown = this.querySelector("#menu");
      dropdown.classList.toggle("hidden");
    });
  }
}
customElements.define("nav-component", NavComponent);
