from flask import Flask, request, jsonify, send_from_directory
import pandas as pd
from flask_cors import CORS
import os

app = Flask(__name__)
CORS(app)  # Allow frontend communication

# Load the CSV file
csv_file = "dataset.csv"  # Ensure this file exists in the same directory
try:
    df = pd.read_csv(csv_file, encoding="utf-8")
except Exception as e:
    print(f"Error loading CSV: {e}")
    df = pd.DataFrame(columns=["Question", "Answer"])  # Create empty DataFrame if CSV fails

# Serve the HTML file
@app.route("/")
def home():
    return send_from_directory(".", "index.html")

# Serve static files (CSS, JS, images)
@app.route("/<path:filename>")
def static_files(filename):
    return send_from_directory(".", filename)

# Handle chatbot queries
@app.route("/query", methods=["POST"])
def handle_query():
    data = request.json
    user_query = data.get("question", "").lower().strip()  # Match frontend key

    # Search for the answer in the CSV
    answer = search_csv(user_query)
    
    return jsonify({"answer": answer})

def search_csv(query):
    # Convert query to lowercase for case-insensitive search
    query = query.lower()

    # Filter DataFrame based on matching questions
    result = df[df["Question"].str.lower().str.contains(query, case=False, na=False)]

    if not result.empty:
        return result.iloc[0]["Answer"]  # Return first matched answer
    else:
        return "Sorry, I couldn't find an answer to your question."

if __name__ == "__main__":
    app.run(debug=True)