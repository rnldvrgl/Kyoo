const pendingTicketsTab = window.Echo.channel("public.pending-tickets");

    pendingTicketsTab.subscribed((e) => {
        console.log("Subscribed");
    })
    .listen("PendingTicketsEvent", (e) => {
        let ticket = e.queueTicket;

        let hasCurrentServingTicket = false;

        // Div where I will append ticketHasSomething
        let pendingTab = $('#pending-tab');

        // Content of each card
        let rowID = ticket.id;
        let ticketID = ticket.ticket_number;
        let createdAt = $.format.date(ticket.created_at, 'Y-m-d h:i:s A');
        let studentName = ticket.student_name;
        let department = ticket.student_department;
        let course = ticket.student_course;

        // AJAX Fetch
        let services = axios.get('/fetch-services/' + rowID)
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });

        // let servicedepartment = ;
        let clearanceStatus = ticket.clearance_status;


        if(ticket){
            let ticketHasSomething = `
            <div class="my-1">
                <div class="card rounded-3 shadow-sm w-100 px-4 py-4" id="queue-card-${rowID}" style="border-left: 8px solid #E67E22; background-color: #f7f7f7;">
                    <div class="row d-flex justify-content-evenly">
                        <div class="col-lg-6 mb-4 text-left">
                            <div class="mb-2">
                                <h3 class="fw-bold text-center mb-0">${ticketID}</h3>
                                <small class="text-center d-block">${createdAt}</small>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold mb-0">Student Name:</h6>
                                <p class="mb-0">${studentName}</p>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold mb-0">Department:</h6>
                                <p class="mb-0">${department}</p>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Course:</h6>
                                <p class="mb-0">${course}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 h-100">
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">Selected Services:</h6>
                                <ul class="list-group">
                                    <li class="bg-transparent border-0">${services}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;

            pendingTab.append(ticketHasSomething);
        } else {
            let ticketHasNothing = `
                <div class="text-center my-auto">
                    <p class="fw-bold fs-4 mb-0 text-muted">No Pending Ticket(s)</p>
                </div>
            `;

            pendingTab.append(ticketHasNothing);
        }
        console.log(ticket);
    });