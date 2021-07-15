<aside class="border bg-white p-3">
    <div class="sidebar-menu">
        <ul>
            <li class="sidebar-dropdown new-contact-btns">
                <a href="{{ route('contact.index',[$org_id]) }}">
                    <span>All Contacts</span>
                </a>

                <a href="{{ route('contact.create',[$org_id]) }}">
                    <span class="badge badge-pill badge-danger">New</span>
                </a>

            </li>

            <!-- <li class="sidebar-dropdown new-contact-btns">


                    <button type="button" class="badge badge-pill badge-danger" data-toggle="modal" data-target="#modal-default">
                        New
                    </button>

            </li> -->

        </ul>
    </div>
    <!-- sidebar-menu  -->
</aside>
