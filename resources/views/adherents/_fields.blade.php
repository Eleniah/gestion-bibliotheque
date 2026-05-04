<div class="form-group">
    <label for="prenom">First Name:</label>
    <input type="text" class="form-control" id="prenom" name="prenom"
           value="{{ old('prenom', $adherent->prenom ?? '') }}" required>
</div>

<div class="form-group">
    <label for="nom">Last Name:</label>
    <input type="text" class="form-control" id="nom" name="nom"
           value="{{ old('nom', $adherent->nom ?? '') }}" required>
</div>

<div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email"
           value="{{ old('email', $adherent->email ?? '') }}" required>
</div>
