#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>
#define TRUE 1
#define FALSE 0
#define MAXLINE 1000

typedef struct _person {
   char first_name[MAXLINE];
   char last_name[MAXLINE];
} Person;

Person *person_creator() {
	Person *person = malloc(sizeof(*person));
	return person;
}

void help(char *message) {
	fprintf(stderr, "%s", message);
	exit(EXIT_FAILURE);
}

void person_writer(char *filename, Person *person[], int person_count) {
	FILE *fp;
	if ((fp = fopen(filename, "w")) == NULL)
		help("dosya okunmak icin acilmadi!");
	int i;
	for (i = 0; i < person_count; i++)
		fprintf(fp, "%s %s\n", person[i]->last_name, person[i]->first_name);
	fclose(fp);
}

int last_name_woman(char *last_name, int length) {
	return last_name[length] == 'a' && last_name[length - 1] == 'v' && (last_name[length - 2] == 'e' || last_name[length - 2] == 'o');
}

int last_name_man(char *last_name, int length) {
	return last_name[length] == 'v' && (last_name[length - 1] == 'e' || last_name[length - 1] == 'o');
}

int end_of_word(char c) {
	return  c == ' ' || c == '\t' || c == '\n' || c == '\r' ||
		c == '.' || c == ','  || c == ':'  || c == ';'  ||
		c == '!' || c == '?'  || c == '\'' || c == '"';
}

// 1
void person_analysis(char *filename) {
	Person *LADIES[MAXLINE], *GENTLEMEN[MAXLINE];
	int LADIES_INDEX = 0, GENTLEMEN_INDEX = 0;
	int LADIES_STATE = FALSE, GENTLEMEN_STATE = FALSE;

	FILE *fp;
	if ((fp = fopen(filename, "r")) == NULL)
		help("dosya okunmak icin acilmadi");

	int i;
	char c, word[MAXLINE], before_word[MAXLINE];
	for (i = 0; fscanf(fp, "%c", &c) != EOF;) {
		if (end_of_word(c) && i != 0) {
			word[i] = '\0';
			if (GENTLEMEN_STATE) { // catch gentlemen?
				strcpy(GENTLEMEN[GENTLEMEN_INDEX++]->first_name, word);
				GENTLEMEN_STATE = FALSE;
			} else if (LADIES_STATE) { // catch ladies?
				strcpy(LADIES[LADIES_INDEX++]->first_name, word);
				LADIES_STATE = FALSE;
			} else { // analysis of lastname
				if (strcmp(word, "kizi") == 0) {
					LADIES[LADIES_INDEX] = person_creator();
					strcpy(LADIES[LADIES_INDEX]->last_name, strcat(before_word, " kizi"));
					LADIES_STATE = TRUE;
				}
				else if (strcmp(word, "uulu") == 0) {
					GENTLEMEN[GENTLEMEN_INDEX] = person_creator();
					strcpy(GENTLEMEN[GENTLEMEN_INDEX]->last_name, strcat(before_word, " uulu"));
					GENTLEMEN_STATE = TRUE;
				} else {
					int length = strlen(word) - 1;
					if (last_name_woman(word, length)) { // women
						LADIES[LADIES_INDEX] = person_creator();
						strcpy(LADIES[LADIES_INDEX]->last_name, word);
						LADIES_STATE = TRUE;
					} else if (last_name_man(word, length)) { // men
						GENTLEMEN[GENTLEMEN_INDEX] = person_creator();
						strcpy(GENTLEMEN[GENTLEMEN_INDEX]->last_name, word);
						GENTLEMEN_STATE = TRUE;
					}
				}
			}
			strcpy(before_word, word);
			i = 0;
		} else if (!end_of_word(c)){
			word[i++] = c;
		}
	}

	person_writer("bay.txt", GENTLEMEN, GENTLEMEN_INDEX);
	person_writer("bayan.txt", LADIES, LADIES_INDEX);

}
// 2
void relatives_analysis(char *sourcefile1, char *sourcefile2, char *targetfile) {
	FILE *fp1, *fp2, *fp3;
	if ((fp1 = fopen(sourcefile1, "r")) == NULL)
		help("dosya okunmak icin acilmadi");

	int i;
	char row1[MAXLINE], row2[MAXLINE];

	// first last_name
	char *last_name;
	int length_last_name;

	// other last_name
	char *last_name_of_other;
	int length_last_name_of_other;

	// relative person
	char RELATIVE_PERSON[MAXLINE][MAXLINE];
	int RELATIVE_PERSON_INDEX = 0;

	for (i = 0; fgets(row1, sizeof(row1), fp1) != NULL; i++) {

		last_name = strtok(strdup(row1), " "); // get last_name of sourcefile1
		length_last_name = strlen(last_name) - 1;

		if (last_name_woman(last_name, length_last_name)) // crop last_name_of_woman
			last_name[length_last_name - 2] = '\0';

		if (last_name_man(last_name, length_last_name)) // crop last_name_of_man
			last_name[length_last_name - 1] = '\0';

		if ((fp2 = fopen(sourcefile2, "r")) == NULL)
			help("dosya okunmak icin acilmadi");

		last_name = strdup(last_name);

		for (i = 0; fgets(row2, sizeof(row2), fp2) != NULL; i++) {

			last_name_of_other = strtok(strdup(row2), " "); // get last_name of sourcefile2
			length_last_name_of_other = strlen(last_name_of_other) - 1;

			if (last_name_woman(last_name_of_other, length_last_name_of_other)) // crop last_name_of_woman
				last_name_of_other[length_last_name_of_other - 2] = '\0';

			if (last_name_man(last_name_of_other, length_last_name_of_other)) // crop last_name_of_man
				last_name_of_other[length_last_name_of_other - 1] = '\0';

			if (strcmp(last_name, last_name_of_other) == 0) { // Do man and woman relatives ?
				strcpy(RELATIVE_PERSON[RELATIVE_PERSON_INDEX++], row1);
				strcpy(RELATIVE_PERSON[RELATIVE_PERSON_INDEX++], row2);
			}
		}
	}

	if ((fp3 = fopen(targetfile, "w")) == NULL)
		help("dosya okunmak icin acilmadi");

	for (i = 0; i < RELATIVE_PERSON_INDEX; i++)
		fprintf(fp3, "%s", RELATIVE_PERSON[i]);
}

// 3
void married_analysis(char *filename, char *searcfile, char *targetfile, int index) {

	FILE *fp;
	if ((fp = fopen(filename, "r")) == NULL)
		help("dosya okunmak icin acilmadi");

	int i, row_state = FALSE;
	char row[MAXLINE];

	for (i = 0; fgets(row, sizeof(row), fp) != NULL; i++)
		if (i == index) {
			row_state = TRUE;
			break;
		}
	fclose(fp);

	if (!row_state) // disallowed access
		help("verilen index, kayit numarasini asti");

    char *last_name_of_woman = strtok(row, " ");
    int length_last_name_of_woman = strlen(last_name_of_woman) - 1;

	if (last_name_woman(last_name_of_woman, length_last_name_of_woman)) // crop last_name_of_woman
		last_name_of_woman[length_last_name_of_woman - 2] = '\0';

	if ((fp = fopen(searcfile, "r")) == NULL)
		help("dosya okunmak icin acilmadi");

	last_name_of_woman = strdup(last_name_of_woman);

	char RELATIVE_MEN[MAXLINE][MAXLINE];
	int RELATIVE_MEN_INDEX = 0;
	char *last_name_of_man;
	int length_last_name_of_man;

	for (i = 0; fgets(row, sizeof(row), fp) != NULL; i++) {

		last_name_of_man = strtok(strdup(row), " ");
		length_last_name_of_man = strlen(last_name_of_man) - 1;

		if (last_name_man(last_name_of_man, length_last_name_of_man)) // crop last_name_of_man
			last_name_of_man[length_last_name_of_man - 1] = '\0';

		if (strcmp(last_name_of_woman, last_name_of_man) != 0) // Do man and woman relatives ?
			strcpy(RELATIVE_MEN[RELATIVE_MEN_INDEX++], row);
	}
	fclose(fp);

	if ((fp = fopen(targetfile, "w")) == NULL)
		help("dosya okunmak icin acilmadi");

	for (i = 0; i < RELATIVE_MEN_INDEX; i++)
		fprintf(fp, "%s", RELATIVE_MEN[i]);
	fclose(fp);
}

// 4
void translate_last_name(char *filename, char *targetfile) {
	FILE *fp;
	if ((fp = fopen(filename, "r")) == NULL)
		help("dosya okunmak icin acilmadi");

	char TRANSLATE_PERSON[MAXLINE][MAXLINE];
	int TRANSLATE_PERSON_INDEX = 0;
	int length_word, i = 0;
	char row[MAXLINE], new_row[MAXLINE] = "", *word;

	for (i = 0; fgets(row, sizeof(row), fp) != NULL; i++) {
		word = strtok(strdup(row), " \n\r");
		while (word != NULL) {

			length_word = strlen(word) - 1;
			if (last_name_woman(word, length_word)) { // crop and fix last_name_of_woman
				word[length_word - 2] = '\0';
				word = strcat(strdup(word), " kizi");
			}
			else if (last_name_man(word, length_word)) { // crop and fix last_name_of_man
				word[length_word - 1] = '\0';
				word = strcat(strdup(word), " uulu");
			}

			if (strcmp(new_row, "") == 0)
				strcpy(new_row, word);
			else
				strcpy(new_row, strcat(strcat(new_row, " "), word));

			word = strtok(NULL, " \n\r");
		}
		strcpy(TRANSLATE_PERSON[TRANSLATE_PERSON_INDEX++], new_row);
		strcpy(new_row, "");
	}
	fclose(fp);

	if ((fp = fopen(targetfile, "w")) == NULL)
		help("dosya okunmak icin acilmadi");

	for (i = 0; i < TRANSLATE_PERSON_INDEX; i++)
		fprintf(fp, "%s\n", TRANSLATE_PERSON[i]);
	fclose(fp);
}

int main() {

	// 1
		person_analysis("inText.txt");

	// 2
		relatives_analysis("bay.txt", "bayan.txt", "akrabalar.txt"); // herhangi 2 verilen dosyada akrabaliklari bulur

	// 3
		married_analysis("bayan.txt", "bay.txt", "evlenebilecek-adaylar.txt", 3); // 3 nolu kisinin evlenme adaylari
		married_analysis("bayan.txt", "bay.txt", "evlenebilecek-adaylar.txt", 6); // 6 nolu kisinin evlenme adaylari

	// 4
		translate_last_name("bayan.txt", "translate-bayan.txt");
		translate_last_name("bay.txt",   "translate-bay.txt");

	exit(EXIT_SUCCESS);
}