<a href="#" class="btn-wpem-modal" data-modal="addsv">BUTTON</a>

<div class="wpem-backdrop"></div>

<div id="addsv" class="wpem-modal">
  <div class="wpem-modal-content">
    <!-- Btn close -->
    <a href="#" class="wpem-btn-close-modal" data-modal="addsv">
      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
        <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
      </svg>
    </a>
    <!-- End btn close -->

    <h3>Modal</h3>
    <br />

    <form id="add_new_cus" action="">
      <div class="subcriber-avatar">
        <img src="https://i.pravatar.cc/150?img=60" alt="">
        <div class="change-image-hover"><span> IMAGE </span></div>
      </div>

      <div class="wpem__row-2">
        <div class="wpem__group-input">
          <label for="first_name" class="label">First name</label>
          <input id="first_name" name="first_name" type="text" placeholder="First name">
        </div>
        <div class="wpem__group-input">
          <label for="last_name" class="label">Last name</label>
          <input id="last_name" name="last_name" type="text" placeholder="Last name">
        </div>
      </div>

      <div class="wpem__group-input">
        <label for="email" class="label">Email</label>
        <input id="email" name="email" type="text" placeholder="Email">
      </div>

      <div class="wpem__group-input">
        <label for="phone" class="label">Phone</label>
        <input id="phone" name="phone" type="text" placeholder="Phone">
      </div>

      <div class="wpem__group-input">
        <label for="age" class="label">Age</label>
        <input id="age" name="age" type="number" placeholder="Age">
      </div>

      <div class="wpem__group-choose">
        <label for="full_name" class="label">Gender</label>

        <div class="wpem__options">
          <label class="wpem__choose-option">
            <input id="male" type="radio" name="gender" class="wpem__choose-input" value="0" checked>
            <div class="wpem__choose-input-label">Male</div>
          </label>
          <label class="wpem__choose-option">
            <input id="fmale" type="radio" name="gender" class="wpem__choose-input" value="1">
            <div class="wpem__choose-input-label">Famale</div>
          </label>
        </div>
      </div>

      <div class="wpem__group-input">
        <label for="location" class="label">Location</label>
        <input id="location" name="location" type="text" placeholder="Location">
      </div>

      <div class="wpem__group-input">
        <label for="desc" class="label">Description</label>
        <textarea name="desc" id="desc" placeholder="Description"></textarea>
      </div>

      <div class="wpem__group-input">
        <label for="note" class="label">Note</label>
        <textarea id="note" name="note" placeholder="Note"></textarea>
      </div>

      <div class="wpem__group-input">
        <label for="status" class="label">Status</label>
        <select id="status" name="status">
          <option value="0">Select car:</option>
          <option value="1">Audi</option>
          <option value="2">BMW</option>
          <option value="3">Citroen</option>
        </select>
      </div>
      <br />
      <button type="submit" class="wpem-btn">
        ADD NEW DATABASE
      </button>
    </form>

  </div>
</div>