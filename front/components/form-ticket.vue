<template>
    <div>
        <v-dialog v-model="dialog" width="750">
            <div class="add-form">
                <h3 v-if="id==0">CREER UN TICKET</h3>
                <h3 v-else>MODIFIER UN TICKET</h3>

                <div class="formulaire">
                    <p class="error-custom" v-if="error != ''">{{error}}</p>

                    <div class="form-row-1">
                        <v-text-field v-model="title" label="Titre" color="teal accent-4" required ></v-text-field>

                        <v-select
                            v-model="statut"
                            :items="listStatut"
                            item-text="text"
                            item-value="value"
                            label="Statut"
                            required
                            color="teal accent-4"
                        ></v-select>
                    </div>

                    <v-textarea v-model="message" label="Message" color="teal accent-4" required> </v-textarea>

                    
                
                    <div class="button">
                        <v-btn  @click="close" color="red lighten-1"  class="white--text" elevation="0">Annuler</v-btn>
                        <v-btn @click="save" color="teal accent-4" class="white--text" elevation="0" v-if="id==0">Créer</v-btn>
                        <v-btn @click="save" color="teal accent-4" class="white--text" elevation="0" v-else>Modifier</v-btn>
                    </div>
                </div>
            </div>  
        </v-dialog>
    </div>
</template>

<script>
export default {
    props: {
        id: { type: Number, default: 0 },
        titleDefault: { type: String, default: "" },
        messageDefault: { type: String, default: "" },
        statutDefault: { type: String, default: "en attente" }
    },
    data () {
        return {
            dialog: false,
            title: this.titleDefault,
            message: this.messageDefault,
            statut: this.statutDefault,
            error: "",

            listStatut: [
                { "text": "En attente", "value": "en attente" },
                { "text": "En cours", "value": "en cours" },
                { "text": "Traité", "value": "traité" },
                { "text": "Annulé", "value": "annulé" },
            ]
        }
    },
    watch: {
        titleDefault() {
            this.title = this.titleDefault;
        },
        messageDefault() {
            this.message = this.messageDefault;
        },
        statutDefault() {
            this.statut = this.statutDefault;
        }
    },
    methods: {
        open() {
            this.dialog = true;
        },
        close(){
            this.title = "";
            this.message = "";
            this.error = "";
            this.dialog = false;
        },
        save(){
            let ticket = {
                TCK_TITLE: this.title,
                TCK_MESSAGE: this.message,
                TCK_TYPE: this.statut
            }   

            if(this.id == 0) {
                this.$axios.$post("/api/ticket", ticket).then(result => {
                    this.error = "";
                    if(result[0] != "true") {
                        this.error = result[0];
                    } else {
                        this.$emit("update");
                        this.close();
                    }
                });
            } else {
                this.$axios.$put("/api/ticket/"+this.id, ticket).then(result => {
                    this.error = "";
                    if(result[0] != "true") {
                        this.error = result[0];
                    } else {
                        this.$emit("update");
                        this.close();
                    }
                });
            }
        }
    }
}
</script>