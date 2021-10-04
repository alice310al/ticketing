<template>
  <div>
    <div class="content">
        <div class="content-header">
            <h3>LISTE DES TICKETS</h3>
            <v-icon class="add-icon" @click="newTicket" large>mdi-plus-box</v-icon>
        </div>
        <div class="content-body">
            <v-simple-table fixed-header height="40rem">
                <thead>
                    <tr>
                        <th class="text-left"> Titre </th>
                        <th class="text-left"> Message </th>
                        <th class="text-left"> Statut </th>
                        <th class="text-left"></th>
                    </tr>
                </thead>
                <tbody v-if="tabTickets.length > 0">
                    <tr  v-for="ticket in tabTickets" :key="ticket.TCK_ID">
                        <td @click="updateTicket(ticket)">{{ticket.TCK_TITLE}}</td>
                        <td @click="updateTicket(ticket)">{{ticket.TCK_MESSAGE}}</td>
                        <td width="50rem" @click="updateTicket(ticket)"><v-chip small class="white--text ml-0" :color="tabColorStatut[ticket.TCK_TYPE]">{{upperFirstLetter(ticket.TCK_TYPE)}}</v-chip></td>
                        <td width="50rem"><v-icon @click="deleteTicket(ticket.TCK_ID)" color="red">mdi-delete</v-icon></td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="4" class="text-center">Aucun ticket</td>
                    </tr>
                </tbody>
            </v-simple-table>
        </div>
    </div>
    <form-ticket :statutDefault="statut" :titleDefault="title" :messageDefault="message" :id="id" @update="initTickets" ref="formTicket"/>
  </div>
</template>

<script>
import FormTicket from '~/components/form-ticket.vue';
export default {
    components: { FormTicket },
    data () {
        return {
            tabTickets: [],
            
            // Données du composant form-ticket
            title: "",
            message: "",
            statut: "",
            id: 0,

            // Parametrage
            tabColorStatut: {
                "en attente": "yellow darken-2",
                "en cours": "blue lighten-1",
                "traité": "green lighten-1",
                "annulé": "red lighten-1",
            }
        }
    },
    created() {
        this.$root.updateTitle("LISTE");
        this.initTickets();
    },
    methods: {
        updateTicket(ticket) {
            // Remise a vide pour que le composant détecte les changements
            this.title = "";
            this.message = "";
            this.statut = "";

            this.$nextTick(() => {
                this.id = parseInt(ticket.TCK_ID);
                this.title = ticket.TCK_TITLE;
                this.message = ticket.TCK_MESSAGE;
                this.statut = ticket.TCK_TYPE;

                this.open();
            })
            
        },
        newTicket() {
            this.id = 0;
            this.title = "";
            this.message = "";
            this.statut = "en attente";

            this.open();
        },
        deleteTicket(id) {
            this.$axios.$delete("/api/ticket/"+id).then(result => {
                this.initTickets();
            });
        },
        open(){
            this.$refs.formTicket.open();
        },
        initTickets() {
            this.$axios.$get("/api/ticket").then(result => {
                this.tabTickets = result;
            })
        },
        upperFirstLetter(value) {
            return value.charAt(0).toUpperCase() + value.slice(1);
        }
    }

}
</script>