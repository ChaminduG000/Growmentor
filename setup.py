from flask import Flask, session, request, redirect, url_for, render_template, flash
from werkzeug.utils import secure_filename
from flask_sqlalchemy import SQLAlchemy
from sqlalchemy import text, or_
import bcrypt
import os
import tensorflow as tf
import numpy as np
import secrets
from datetime import datetime
import tensorflow

# Generate a secure random secret key
secret_key = secrets.token_hex(16)

app = Flask(__name__)
app.secret_key = secret_key

BASE_DIR = os.path.dirname(os.path.realpath(__file__))
MODEL_DIR = os.path.join(BASE_DIR, 'model')
UPLOAD_FOLDER = os.path.join(BASE_DIR, 'uploads')
ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg'}

MODEL = tf.keras.models.load_model(os.path.join(MODEL_DIR, 'PD_new_model.h5'))
CLASSES = ['Aloevera___healthy_leaf', 'Aloevera___rot', 'Aloevera___rust', 'Apple___Apple_scab', 'Apple___Black_rot',
           'Apple___Cedar_apple_rust', 'Apple___healthy', 'Background_without_leaves', 'Cherry___Powdery_mildew',
           'Cherry___healthy', 'Corn___Cercospora_leaf_spot Gray_leaf_spot', 'Corn___Common_rust',
           'Corn___Northern_Leaf_Blight', 'Corn___healthy', 'Grape___Black_rot', 'Grape___Esca_(Black_Measles)',
           'Grape___Leaf_blight_(Isariopsis_Leaf_Spot)', 'Grape___healthy', 'Peach___Bacterial_spot', 'Peach___healthy',
           'Pepper,_bell___Bacterial_spot', 'Pepper,_bell___healthy', 'Potato___Early_blight', 'Potato___Late_blight',
           'Potato___healthy', 'Rose___Healthy_Leaf', 'Rose___Rust', 'Rose___sawfly_Rose_slug', 'Strawberry___Leaf_scorch',
           'Strawberry___healthy', 'Tea___algal_leaf', 'Tea___Anthracnose', 'Tea___bird eye spot', 'Tea___brown blight',
           'Tea___gray light', 'Tea___healthy', 'Tea___red leaf spot', 'Tea___white spot', 'Tomato___Bacterial_spot',
           'Tomato___Early_blight', 'Tomato___Late_blight', 'Tomato___Leaf_Mold', 'Tomato___Tomato_mosaic_virus',
           'Tomato___Septoria_leaf_spot', 'Tomato___Target_Spot', 'Tomato___Spider_mites Two-spotted_spider_mite',
           'Tomato___Tomato_Yellow_Leaf_Curl_Virus', 'Tomato___healthy']

app.config['UPLOAD_FOLDER'] = 'static/uploads'
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://root:@localhost/growmentor'
db = SQLAlchemy(app)

class User(db.Model):
    __tablename__ = 'users'

    user_id = db.Column(db.Integer, primary_key=True)
    first_name = db.Column(db.String(255), nullable=False)
    last_name = db.Column(db.String(255), nullable=False)
    phone_number = db.Column(db.String(10), unique=True, nullable=False)
    password = db.Column(db.String(255), nullable=False)

    def __init__(self, first_name, last_name, phone_number, password):
        self.first_name = first_name
        self.last_name = last_name
        self.phone_number = phone_number
        self.password = password

class PlantDisease(db.Model):
    __tablename__ = 'plant_disease'

    ID = db.Column(db.Integer, primary_key=True)
    plant_disease = db.Column(db.String(255), nullable=False)
    Treatment = db.Column(db.Text)
    Link1 = db.Column(db.String(255))

    def __init__(self, plant_disease, Treatment, Link1):
        self.plant_disease = plant_disease
        self.Treatment = Treatment
        self.Link1 = Link1

class FormSubmission(db.Model):
    __tablename__ = 'form_submissions'

    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255), nullable=False)
    phone_number = db.Column(db.String(20))
    message = db.Column(db.Text)
    submission_date = db.Column(db.TIMESTAMP, default=datetime.utcnow)

    def __init__(self, name, phone_number, message):
        self.name = name
        self.phone_number = phone_number
        self.message = message


class Post(db.Model):
    __tablename__ = 'posts'

    post_id = db.Column(db.Integer, primary_key=True)
    post_caption = db.Column(db.String(255), nullable=False)
    post_public = db.Column(db.String(1), nullable=False)
    post_by = db.Column(db.Integer, db.ForeignKey('users.user_id'), nullable=False)
    post_photo = db.Column(db.String(255))
    post_time = db.Column(db.TIMESTAMP, default=datetime.utcnow, nullable=False)  # Add this line

    # Define relationships
    user = db.relationship('User', backref='posts')

    def __init__(self, post_caption, post_public, post_by, post_photo):
        self.post_caption = post_caption
        self.post_public = post_public
        self.post_by = post_by
        self.post_photo = post_photo

# Inside the User class, add a relationship for posts
posts = db.relationship('Post', backref='user', lazy=True)

@app.route('/')
def home():
    return render_template("index.html")

@app.route('/khub', methods=['GET', 'POST'])
def khub_route():
    phone_number = session.get('phone_number')

    if phone_number:
        # User is already logged in, fetch user details and render the template
        user = User.query.filter_by(phone_number=phone_number).first()

        # Handle search query
        search_query = request.form.get('search_query', '')

        if request.method == 'POST' and search_query:
            # Split the search query into individual words
            search_words = search_query.split()

            # Create a list of conditions for each search word
            conditions = [Post.post_caption.ilike(f"%{word}%") for word in search_words] + [
                User.first_name.ilike(f"%{word}%") for word in search_words
            ]

            # Combine conditions with OR to search for any of the search words
            search_condition = or_(*conditions)

            # Perform a search based on the search condition
            posts = Post.query.join(User).filter(search_condition).order_by(Post.post_time.desc()).all()
        else:
            # Fetch all posts from the database
            posts = Post.query.order_by(Post.post_time.desc()).all()

        return render_template('khub.html', user=user, phone_number=phone_number, posts=posts)
    else:
        flash('User not logged in', 'error')
        return redirect(url_for('login'))

@app.route('/submit_post.php', methods=['POST'])
def submit_post():
    if 'phone_number' not in session:
        flash('User not logged in', 'error')
        return redirect(url_for('login'))

    post_caption = request.form.get('post_caption')
    post_public = request.form.get('post_public', 'N')
    phone_number = session['phone_number']

    if 'post_photo' in request.files:
        file = request.files['post_photo']
        if file and file.filename != '' and '.' in file.filename and file.filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS:
            filename = secrets.token_hex(8) + "_" + secure_filename(file.filename)
            file_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
            file.save(file_path)
        else:
            filename = None
    else:
        filename = None

    # Fetch user details using phone_number
    user = User.query.filter_by(phone_number=phone_number).first()

    query = text(f"INSERT INTO posts (post_caption, post_public, post_by, post_photo) VALUES "
                 f"('{post_caption}', '{post_public}', '{user.user_id}', '{filename}')")

    db.session.execute(query)
    db.session.commit()

    flash('Post submitted successfully!', 'success')

    return redirect(url_for('khub_route'))


def allowed_file(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS


@app.route('/login', methods=['GET', 'POST'])
def login():
    error_message = None  # Initialize the error message variable

    if request.method == 'POST':
        phone_number = request.form['phone_number']
        password = request.form['password']

        # Query the database to check if the user exists
        user = User.query.filter_by(phone_number=phone_number).first()

        if user and bcrypt.checkpw(password.encode('utf-8'), user.password.encode('utf-8')):
            # Login successful, store user's phone number and first name in the session
            session['phone_number'] = user.phone_number
            session['first_name'] = user.first_name  # Add this line to store the first name
            flash('Welcome to Growmentor!', 'success')
            return redirect(url_for('home'))  # Redirect to the home page
        else:
            error_message = 'Invalid phone number or password'  # Set the error message

    return render_template('login.html', error_message=error_message)  # Pass the error message to the template



@app.route('/signUp', methods=['GET', 'POST'])
def signup():
    if request.method == 'POST':
        first_name = request.form['first_name']
        last_name = request.form['last_name']
        phone_number = request.form['phone_number']
        password = request.form['password']

        # Check if the phone number is already registered
        existing_user = User.query.filter_by(phone_number=phone_number).first()

        if existing_user:
            flash('Phone number is already registered', 'error')
        else:
            # Hash the password before storing it in the database using bcrypt
            hashed_password = bcrypt.hashpw(password.encode('utf-8'), bcrypt.gensalt())

            # Create a new user and add it to the database
            new_user = User(first_name=first_name, last_name=last_name, phone_number=phone_number,password=hashed_password.decode('utf-8'))
            db.session.add(new_user)
            db.session.commit()

            flash('Signup successful! You can now log in.', 'success')

    return render_template('signUp.html')
    return redirect(url_for('login'))



@app.route('/dashboard')
def dashboard():
    # Check if the user is logged in (has a phone number in the session)
    if 'phone_number' in session:
        return render_template('dashboard.html', phone_number=session['phone_number'])
    else:
        return redirect(url_for('login'))

@app.route('/logout')
def logout():
    # Clear the user's phone number from the session (logout)
    session.pop('phone_number', None)
    return redirect(url_for('login'))

@app.route('/about')
def aboutme():
    return render_template('about.html')

@app.route('/plantdisease/<res>')
def plantresult(res):
    corrected_result = ""
    for i in res:
        if i != '_':
            corrected_result = corrected_result + i

    # Query the database to get the treatment and Link1 for the detected disease
    disease_info = PlantDisease.query.filter_by(plant_disease=corrected_result).first()

    if disease_info:
        # Disease is in the database
        treatment = disease_info.Treatment
        Link1 = disease_info.Link1
        return render_template('plantdiseaseresult.html', corrected_result=corrected_result, treatment=treatment, Link1=Link1)
    else:
        # Disease is not in the database
        flash('Retry:Uploaded Plant Disease Not Found In Our Database', 'error')  # Add this line to flash a retry message
        return redirect(url_for('detect_plant_disease'))

@app.route('/plantdisease', methods=['GET', 'POST'])
def detect_plant_disease():
    if 'phone_number' not in session:
        print('Redirecting to login page')
        return redirect(url_for('login'))  # Redirect to the login page if not logged in

    if request.method == 'POST':
        if 'file' not in request.files:
            flash('No file part', 'error')
            return redirect(request.url)

        file = request.files['file']

        if file.filename == '':
            flash('No selected file', 'error')
            return redirect(request.url)

        if file and allowed_file(file.filename):
            filename = secure_filename(file.filename)
            file.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))
            model = MODEL
            imagefile = tensorflow.keras.utils.load_img(os.path.join(app.config['UPLOAD_FOLDER'], filename), target_size=(224, 224, 3))
            input_arr = tensorflow.keras.preprocessing.image.img_to_array(imagefile)
            input_arr = np.array([input_arr])
            result = model.predict(input_arr)
            probability_model = tensorflow.keras.Sequential([model, tensorflow.keras.layers.Softmax()])
            predict = probability_model.predict(input_arr)
            p = np.argmax(predict[0])
            res = CLASSES[p]
            return redirect(url_for('plantresult', res=res))
        else:
            flash('Invalid file extension. Allowed extensions are: PNG, JPG, JPEG', 'error')

    return render_template("plantdisease.html")

@app.route('/submit_form', methods=['POST'])
def submit_form():
    if request.method == 'POST':
        name = request.form['name']
        phone_number = request.form['phone_number']
        message = request.form['message']

        # Insert the form data into the database
        try:
            submission = FormSubmission(name=name, phone_number=phone_number, message=message)
            db.session.add(submission)
            db.session.commit()
            flash('Form submitted successfully!', 'success')
        except Exception as e:
            db.session.rollback()
            flash('Error submitting the form: {}'.format(str(e)), 'error')

    return redirect(url_for('home'))
if __name__ == "__main__":
    app.run(debug=True)
